<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
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
    public function store(Request $request)
    {
        // Mendefinisikan pesan kesalahan untuk validasi input
        $messages = [
            'required' => ':attribute harus diisi.',
        ];

        // Mendefinisikan atribut untuk pesan kesalahan
        $attributes = [
            'type' => 'Tipe',
            'size' => 'Ukuran',
            'price' => 'Harga',
            'description' => 'Deskripsi',
        ];

        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'size' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ], $messages);

        // Menggunakan atribut untuk pesan kesalahan
        $validator->setAttributeNames($attributes);

        // Jika terdapat kesalahan validasi, kembalikan kembali ke halaman sebelumnya dengan pesan kesalahan dan input yang diisi sebelumnya
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat slug yang unik
        $slug = Str::slug($request->input('type'), '-');
        $count = GownPackage::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . Str::random(5); // Tambahkan string acak ke slug jika tidak unik
        }

        $gown_package = GownPackage::create([
            'type' => $request->input('type'),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'slug' => $slug
        ]);

        return redirect()->route('admin.gown_packages.edit', [$gown_package])->with([
            'message' => 'Success Created!',
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
    public function update(Request $request, GownPackage $gown_package)
    {
        // Mendefinisikan pesan kesalahan untuk validasi input
        $messages = [
            'required' => ':attribute harus diisi.',
        ];

        // Mendefinisikan atribut untuk pesan kesalahan
        $attributes = [
            'type' => 'Tipe',
            'size' => 'Ukuran',
            'price' => 'Harga',
            'description' => 'Deskripsi',
        ];

        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'size' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ], $messages);

        // Menggunakan atribut untuk pesan kesalahan
        $validator->setAttributeNames($attributes);

        // Jika terdapat kesalahan validasi, kembalikan kembali ke halaman sebelumnya dengan pesan kesalahan dan input yang diisi sebelumnya
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat slug yang unik
        $slug = Str::slug($request->input('type'), '-');
        $count = GownPackage::where('slug', $slug)->where('id', '!=', $gown_package->id)->count();
        if ($count > 0) {
            $slug = $slug . '-' . Str::random(5); // Tambahkan string acak ke slug jika tidak unik
        }

        $gown_package->update([
            'type' => $request->input('type'),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'slug' => $slug
        ]);

        return redirect()->route('admin.gown_packages.index')->with([
            'message' => 'Success Updated!',
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
            'message' => 'Success Deleted!',
            'alert-type' => 'danger'
        ]);
    }
}
