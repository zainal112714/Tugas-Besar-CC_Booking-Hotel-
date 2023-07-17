<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\GownPackageRequest;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GownPackage;
use App\Http\Controllers\Controller;


class GownPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gown_packages = GownPackage::paginate(10);

        return view('admin.gown_packages.index', compact('gown_packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gown_packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GownPackageRequest $request)
    {
        if($request->validated()) {
            $slug = Str::slug($request->size, '-');
            $gown_package = GownPackage::create($request->validated() + ['slug' => $slug ]);
        }

        return redirect()->route('admin.gown_packages.edit', [$gown_package])->with([
            'message' => 'Success Created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GownPackage $gown_package)
    {
        $galleries = Gallery::paginate(10);

        return view('admin.gown_packages.edit', compact('gown_package','galleries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GownPackageRequest $request, GownPackage $gown_package)
    {
        if($request->validated()) {
            $slug = Str::slug($request->size, '-');
            $gown_package->update($request->validated() + ['slug' => $slug]);
        }

        return redirect()->route('admin.gown_packages.index')->with([
            'message' => 'Success Updated !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GownPackage $gown_package)
    {
        $gown_package->delete();

        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
