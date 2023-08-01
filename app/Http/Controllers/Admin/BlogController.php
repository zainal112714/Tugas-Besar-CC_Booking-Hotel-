<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

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

        Alert::success('Added Successfully', ' Blog Data Added
        Successfully.');

        return redirect()->route('admin.blogs.index')->with([
            'message' => 'Berhasil membuat postingan!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
    return view('admin.blogs.show', compact('blog'));
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

        Alert::success('Changed Successfully', ' Blog Data Change
        Successfully.');

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

        Alert::success('Deleted Successfully', ' Blog Data Delete
        Successfully.');

        return redirect()->back()->with([
            'message' => 'Berhasil menghapus postingan!',
            'alert-type' => 'danger'
        ]);
    }

        public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::with('category')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<a href="' . asset(Storage::url($row->image)) . '" target="_blank">
                                <img src="' . asset(Storage::url($row->image)) . '" width="100" alt="">
                            </a>';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.blogs.edit', $row->id);
                    $deleteUrl = route('admin.blogs.destroy', $row->id);
                    $showUrl = route('admin.blogs.show', $row->id);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');

                    $actionButtons = '<div class="btn-group" role="group" aria-label="Action Buttons">';
                    $actionButtons .= '<a href="' . $showUrl . '" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i> View</a>';
                    $actionButtons .= '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="bi bi-pencil"></i> Edit</a>';
                    $actionButtons .= '<form class="d-inline-block" action="' . $deleteUrl . '" method="post" onsubmit="return confirm(\'Are you sure you want to delete this blog?\');">';
                    $actionButtons .= $csrf . $method;
                    $actionButtons .= '<button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</button>';
                    $actionButtons .= '</form>';
                    $actionButtons .= '</div>';

                    return $actionButtons;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return abort(404);
    }

}
