<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\GownPackage;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::get();

        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        $relatedBlogs = Blog::where('id','!=',$blog->id)
                ->where('category_id', $blog->category_id)
                ->get();
        $categories = Category::get();
        $gown_packages = GownPackage::with('galleries')->get()->take(2);

        $blog->incrementReadCount();

        return view('blogs.show', compact('blog','gown_packages','relatedBlogs','categories'));
    }

    public function category(Category $category)
    {
        $blogs = Blog::where('category_id', $category->id)->get();

        return view('blogs.category', compact('blogs', 'category'));
    }
}
