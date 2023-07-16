<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\GownPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Gown_packages = GownPackage::with('galleries')->get();
        $blogs = Blog::get()->take(3);

        return view('homepage', compact('Gown_packages','blogs'));
    }
}
