<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\GownPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\GalleryRequest;

class GalleryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request, GownPackage $gown_package)
    {
        if($request->validated()){
            $images = $request->file('images')->store(
                'gown_package/gallery', 'public'
            );
            Gallery::create($request->except('images') + ['images' => $images,'gown_package_id' => $gown_package->id]);
        }

        return redirect()->route('admin.gown_packages.edit', [$gown_package])->with([
            'message' => 'Success Created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GownPackage $gown_package,Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gown_package','gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request,GownPackage $gown_package, Gallery $gallery)
    {
        if($request->validated()) {
            if($request->images) {
                File::delete('storage/'. $gallery->images);
                $images = $request->file('images')->store(
                    'gown_package/gallery', 'public'
                );
                $gallery->update($request->except('images') + ['images' => $images, 'gown_package_id' => $gown_package->id]);
            }else {
                $gallery->update($request->validated());
            }
        }

        return redirect()->route('admin.gown_packages.edit', [$gown_package])->with([
            'message' => 'Success Updated !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GownPackage $gown_package,Gallery $gallery)
    {
        File::delete('storage/'. $gallery->images);
        $gallery->delete();

        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
