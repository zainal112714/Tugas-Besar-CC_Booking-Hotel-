<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;
use App\Models\GownPackage;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class GalleryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, GownPackage $gown_package)
    {
        $request->validate([
            'name' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif',
        ], [
            'name.required' => 'Nama gambar harus diisi.',
            'images.required' => 'Gambar harus diunggah.',
            'images.image' => 'File harus berupa gambar.',
            'images.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
        ]);

        $images = $request->file('images')->store('gown_package/gallery', 'public');

        Gallery::create([
            'name' => $request->name,
            'images' => $images,
            'gown_package_id' => $gown_package->id
        ]);

        Alert::success('Added Successfully', ' Data Added
        Successfully.');

        return redirect()->route('admin.gown_packages.edit', [$gown_package])->with([
            'message' => 'Berhasil Ditambahkan!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GownPackage $gown_package, Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gown_package', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GownPackage $gown_package, Gallery $gallery)
    {
        $request->validate([
            'name' => 'required',
            'images' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
        ], [
            'name.required' => 'Nama gambar harus diisi.',
            'images.image' => 'File harus berupa gambar.',
            'images.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
        ]);

        if ($request->hasFile('images')) {
            File::delete('storage/' . $gallery->images);
            $images = $request->file('images')->store('gown_package/gallery', 'public');
            $gallery->images = $images;
        }

        $gallery->name = $request->name;
        $gallery->save();

        Alert::success('Changed Successfully', ' Data Change
        Successfully.');

        return redirect()->route('admin.gown_packages.edit', [$gown_package])->with([
            'message' => 'Berhasil Diperbarui!',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GownPackage $gown_package, Gallery $gallery)
    {
        File::delete('storage/' . $gallery->images);
        $gallery->delete();

        Alert::success('Deleted Successfully', ' Data Deleted
        Successfully.');

        return redirect()->back()->with([
            'message' => 'Berhasil Dihapus!',
            'alert-type' => 'danger'
        ]);
    }
}
