<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GownPackage;

class GownPackageController extends Controller
{
    public function index()
    {
        $gown_packages = GownPackage::with('galleries')->get();

        return view('gown_packages.index', compact('gown_packages'));
    }

    public function show(GownPackage $gown_package)
    {
        $gown_packages = GownPackage::where('id', '!=', $gown_package->id)->get();

        return view('gown_packages.show', compact('gown_packages', 'gown_packages'));
    }
}
