<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserLog;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'asc')->with(['post', 'user'])->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function confirmBooking(Booking $booking)
    {
        $booking->update([
            'status'            =>          true
        ]);

        $log_entry = Auth::user()->name . " confirm " . $booking->user->name . " with the id# " . $booking->id;
        event(new UserLog($log_entry));

        return back()->with('message', 'Booking accepted');
    }

    public function checkouted(Booking $booking)
    {
        $post = $booking->post;
        $post->increment('room_quantity');

        $booking->delete();

        $hotel = $post->hotel_name;
        $location = $post->category->name;
        $address = $post->location;
        $user = $booking->user;

        $log_entry = Auth::user()->name . " checkouted " . $user->name . " to the hotel: " . $hotel . " at " . $location . "/" . $address  . " with the id# " . $booking->id;
        event(new UserLog($log_entry));

        return redirect('/admin/bookings')->with('message', 'Checkouted successfully');
    }

    public function searchBooking(Request $request)
    {
        $search = $request->search;

        $bookings = Booking::with(['post', 'user'])
            ->where(function ($query) use ($search) {
                $query->where('post_id', 'like', "%$search%")
                    ->orWhere('user_id', 'like', "%$search%");
            })
            ->orWhereHas('post', function ($postQuery) use ($search) {
                $postQuery->where('description', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%")
                    ->orWhere('hotel_name', 'like', "%$search%")
                    ->orWhere('room_number', 'like', "%$search%")
                    ->orWhere('person_quantity', 'like', "%$search%")
                    ->orWhere('room_quantity', 'like', "%$search%")
                    ->orWhere('location', 'like', "%$search%");
            })
            ->orWhereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('gender', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%");
            })
            ->orWhereHas('post.category', function ($categoryQuery) use ($search) {
                $categoryQuery->where('name', 'like', "%$search%");
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.bookings.searched', compact('bookings', 'search'));
    }

    public function createBooking()
    {
        $users = User::all();
        return view('admin.bookings.create', compact('users'));
    }

    public function getRandomName()
    {
        $users = User::all()->pluck('name')->shuffle()->first();
        return response()->json(['name' => $users]);
    }
}
