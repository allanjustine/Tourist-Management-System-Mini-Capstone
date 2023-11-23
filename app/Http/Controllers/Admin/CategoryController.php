<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserLog;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::orderBy('created_at', 'asc')->paginate(10);
        return view('admin.posts.category', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.posts.create-category');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'          =>          ['required', 'max:255', 'unique:categories,name'],
            'remarks'       =>          ['required']
        ]);

        $category = Category::create($request->all());

        $log_entry = Auth::user()->name . " added an location category name: " . $category->name . " with the id# " . $category->id;
        event(new UserLog($log_entry));
        return redirect('admin/categories')->with('message', 'Category added successfully.');
    }

    public function updateCategory(Category $category)
    {
        return view('admin.posts.edit-category', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'          =>          ['required', 'max:255', 'unique:categories,name->ignore($request->category->id)'],
            'remarks'       =>          ['required']
        ]);

        $category->update($request->all());

        $log_entry = Auth::user()->name . " updated an location category name: " . $category->name . " with the id# " . $category->id;
        event(new UserLog($log_entry));
        return redirect('admin/categories')->with('message', 'Category updated successfully.');
    }

    public function delete(Category $category)
    {

        $log_entry = Auth::user()->name . " deleted the location category name: " . $category->name . " with the id# " . $category->id;
        event(new UserLog($log_entry));
        $category->delete();
        return redirect('admin/categories')->with('message', 'Category deleted successfully.');
    }

    public function searchCategory(Request $request)
    {
        $search = $request->search;

        $categories = Category::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('remarks', 'like', "%$search%");
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.posts.category-searched', compact('categories', 'search'));
    }
}
