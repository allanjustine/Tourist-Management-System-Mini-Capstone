<?php

namespace App\Http\Controllers\NormalView;

use App\Events\UserLog;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function travelAndTours()
    {
        $categories = Category::withCount('posts')->get();

        return view('normal-view.pages.index', compact('categories'));
    }

    public function categoryList(Category $category)
    {

        $categories = Category::orderBy('name', 'asc')->with('posts')->get();

        return view('normal-view.pages.category-list', compact('category', 'categories'));
    }

    public function bookings()
    {

        $bookings = Booking::orderBy('created_at', 'asc')->where('user_id', auth()->id())->with('post')->get();

        return view('normal-view.bookings.index', compact('bookings'));
    }

    public function confirmBooking(Post $post)
    {
        return view('normal-view.bookings.confirm-bookings', compact('post'));
    }

    public function bookingCreate(Request $request)
    {
        $request->validate([
            'post_id'           =>          ['unique:bookings,post_id']
        ]);
        $booked = Booking::create([
            'post_id'       =>          $request->post_id,
            'user_id'       =>          auth()->id()
        ]);

        $post = $booked->post;

        if ($post->room_quantity == 0) {
            return back()->with('error', 'No available rooms. Please check another one.');
        } else {
            $post->decrement('room_quantity');

            $hotel = $post->hotel_name;
            $location = $post->category->name;
            $address = $post->location;

            $log_entry = Auth::user()->name . " has booked a hotel: " . $hotel . " at " . $location . "/" . $address  . " with the id# " . $booked->id;
            event(new UserLog($log_entry));

            return redirect('/bookings')->with('message', 'You successfully booked a hotel. Please pay to the cashier if you arrived at the location');
        }
    }

    public function cancelled(Booking $booking)
    {
        $post = $booking->post;
        $post->increment('room_quantity');

        $booking->delete();

        $hotel = $post->hotel_name;
        $location = $post->category->name;
        $address = $post->location;

        $log_entry = Auth::user()->name . " cancelled the booking in hotel: " . $hotel . " at " . $location . "/" . $address  . " with the id# " . $booking->id;
        event(new UserLog($log_entry));

        return redirect('/bookings')->with('message', 'Booking cancelled successfully');
    }

    public function searchPost(Request $request)
    {
        $search = $request->search;

        $categories = Category::with(['posts' => function ($query) use ($search) {
            $query->where('location', 'like', "%$search%");
        }])
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('remarks', 'like', "%$search%");
            })
            ->orWhereHas('posts', function ($query) use ($search) {
                $query->where('location', 'like', "%$search%");
            })
            ->orderBy('created_at', 'asc')
            ->withCount('posts')
            ->get();
        $navCategories = Category::all();
        return view('normal-view.pages.searched', compact('search', 'categories', 'navCategories'));
    }
}
