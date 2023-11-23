<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserLog;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function searchPost(Request $request)
    {
        $search = $request->search;

        $posts = Post::with('category')
            ->where(function ($query) use ($search) {
                $query->where('description', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%")
                    ->orWhere('hotel_name', 'like', "%$search%")
                    ->orWhere('room_number', 'like', "%$search%")
                    ->orWhere('person_quantity', 'like', "%$search%")
                    ->orWhere('room_quantity', 'like', "%$search%")
                    ->orWhere('location', 'like', "%$search%");
            })
            ->orWhereHas('category', function ($categoryQuery) use ($search) {
                $categoryQuery->where('name', 'like', "%$search%");
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.posts.searched', compact('posts', 'search'));
    }

    public function index(Post $post)
    {
        $posts = Post::orderBy('created_at', 'asc')->with('category')->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function createPost()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_image'            =>          ['required', 'max:10000'],
            'description'           =>          ['required'],
            'price'                 =>          ['required', 'numeric', 'min:1'],
            'hotel_name'            =>          ['required'],
            'room_number'           =>          ['required', 'numeric', 'min:1'],
            'person_quantity'       =>          ['required', 'numeric', 'min:1'],
            'room_quantity'         =>          ['required', 'numeric', 'min:1'],
            'location'              =>          ['required'],
            'date_start'            =>          ['required'],
            'date_end'              =>          ['required'],
            'contact'               =>          ['required'],
            'category_id'           =>          ['required']
        ]);

        $imagePaths = [];

        if ($request->hasFile('post_image')) {
            foreach ($request->file('post_image') as $postImg) {
                $imageFileName = Str::random(20) . '.' . $postImg->getClientOriginalExtension();
                $postImg->storeAs('images/post_pictures', $imageFileName, 'public');
                $imagePaths[] = 'images/post_pictures/' . $imageFileName;
            }
        }

        $post = Post::create([
            'post_image'            =>          $imagePaths,
            'description'           =>          $request->description,
            'price'                 =>          $request->price,
            'hotel_name'            =>          $request->hotel_name,
            'room_number'           =>          $request->room_number,
            'person_quantity'       =>          $request->person_quantity,
            'room_quantity'         =>          $request->room_quantity,
            'location'              =>          $request->location,
            'date_start'            =>          $request->date_start,
            'date_end'              =>          $request->date_end,
            'contact'               =>          $request->contact,
            'category_id'           =>          $request->category_id
        ]);

        $log_entry = Auth::user()->name . " added an post location: " . $post->location . " with the id# " . $post->id;
        event(new UserLog($log_entry));

        return redirect('/admin/posts')->with('message', 'Posted successfully');
    }

    public function updatePost(Post $post)
    {

        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'post_image'            =>          ['max:10000'],
            'description'           =>          ['required'],
            'price'                 =>          ['required', 'numeric', 'min:1'],
            'hotel_name'            =>          ['required'],
            'room_number'           =>          ['required', 'numeric', 'min:1'],
            'person_quantity'       =>          ['required', 'numeric', 'min:1'],
            'room_quantity'         =>          ['required', 'numeric', 'min:1'],
            'location'              =>          ['required'],
            'date_start'            =>          ['required'],
            'date_end'              =>          ['required'],
            'contact'               =>          ['required'],
            'category_id'           =>          ['required']
        ]);

        $imagePaths = $post->post_image;

        if ($request->hasFile('post_image')) {

            $newImagePaths = [];
            foreach ($request->file('post_image') as $postImg) {
                $imageFileName = Str::random(20) . '.' . $postImg->getClientOriginalExtension();
                $postImg->storeAs('images/post_pictures', $imageFileName, 'public');
                $newImagePaths[] = 'images/post_pictures/' . $imageFileName;
            }

            if (!empty($post->post_image)) {
                foreach ($post->post_image as $existingImage) {
                    if (!Str::contains($existingImage, 'no-image.png')) {
                        Storage::disk('public')->delete($existingImage);
                    }
                }
            }

            $imagePaths = $newImagePaths;
        }

        $post->update([
            'post_image'            =>          $imagePaths,
            'description'           =>          $request->description,
            'price'                 =>          $request->price,
            'hotel_name'            =>          $request->hotel_name,
            'room_number'           =>          $request->room_number,
            'person_quantity'       =>          $request->person_quantity,
            'room_quantity'         =>          $request->room_quantity,
            'location'              =>          $request->location,
            'date_start'            =>          $request->date_start,
            'date_end'              =>          $request->date_end,
            'contact'               =>          $request->contact,
            'category_id'           =>          $request->category_id
        ]);

        $log_entry = Auth::user()->name . " updated an post location: " . $post->location . " with the id# " . $post->id;
        event(new UserLog($log_entry));

        return redirect('/admin/posts')->with('message', 'Post updated successfully');
    }

    public function delete(Post $post)
    {
        $log_entry = Auth::user()->name . " deleted the post location: " . $post->location . " with the id# " . $post->id;
        event(new UserLog($log_entry));

        if (!empty($post->post_image)) {
            foreach ($post->post_image as $existingImage) {
                if (!Str::contains($existingImage, 'no-image.png')) {
                    Storage::disk('public')->delete($existingImage);
                }
            }
        }

        $post->delete();

        return redirect('/admin/posts')->with('message', 'Post deleted successfully');
    }
}
