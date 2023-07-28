<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator; 

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('category')->paginate(5);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get(['name', 'id']);

        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'excerpt' => 'required',
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'description' => 'required',
            'category_id' => 'required'
        ], [
            'title.required' => 'Judul harus diisi.',
            'excerpt.required' => 'Kutipan harus diisi.',
            'image.required' => 'Gambar harus diisi.',
            'image.image' => 'Gambar harus berupa file gambar.',
            'image.mimes' => 'Gambar harus dalam format png, jpg, atau jpeg.',
            'description.required' => 'Deskripsi harus diisi.',
            'category_id.required' => 'Kategori harus dipilih.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.blogs.create')
                             ->withErrors($validator)
                             ->withInput()
                             ->with([
                                 'message' => 'Silakan perbaiki kesalahan di bawah ini.',
                                 'alert-type' => 'error',
                             ]);
        }

        $image = $request->file('image')->store('blog/images', 'public');
        $slug = Str::slug($request->title, '-');

        Blog::create([
            'title' => $request->input('title'),
            'excerpt' => $request->input('excerpt'),
            'image' => $image,
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'slug' => $slug,
        ]);

        return redirect()->route('admin.blogs.index')->with([
            'message' => 'Berhasil membuat postingan!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::get(['name','id']);

        return view('admin.blogs.edit', compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'excerpt' => 'required',
            'image' => ['image', 'mimes:png,jpg,jpeg'],
            'description' => 'required',
            'category_id' => 'required'
        ], [
            'title.required' => 'Judul harus diisi.',
            'excerpt.required' => 'Kutipan harus diisi.',
            'image.image' => 'Gambar harus berupa file gambar.',
            'image.mimes' => 'Gambar harus dalam format png, jpg, atau jpeg.',
            'description.required' => 'Deskripsi harus diisi.',
            'category_id.required' => 'Kategori harus dipilih.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.blogs.edit', $blog->id)
                             ->withErrors($validator)
                             ->withInput()
                             ->with([
                                 'message' => 'Silakan perbaiki kesalahan di bawah ini.',
                                 'alert-type' => 'error',
                             ]);
        }

        $slug = Str::slug($request->title, '-');
        if ($request->hasFile('image')) {
            File::delete('storage/' . $blog->image);
            $image = $request->file('image')->store('blog/images', 'public');
            $blog->update([
                'title' => $request->input('title'),
                'excerpt' => $request->input('excerpt'),
                'image' => $image,
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'slug' => $slug,
            ]);
        } else {
            $blog->update([
                'title' => $request->input('title'),
                'excerpt' => $request->input('excerpt'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'slug' => $slug,
            ]);
        }

        return redirect()->route('admin.blogs.index')->with([
            'message' => 'Berhasil memperbarui postingan!',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        File::delete('storage/'. $blog->image);
        $blog->delete();

        return redirect()->back()->with([
            'message' => 'Berhasil menghapus postingan!',
            'alert-type' => 'danger'
        ]);
    }
}
