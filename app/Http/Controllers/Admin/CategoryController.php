<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Category::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
        ]);

        Alert::success('Added Successfully', ' Booking Data Added
        Successfully.');

        return redirect()->route('admin.categories.index')->with([
            'message' => 'Success Created!',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
        ]);

        Alert::success('Changed Successfully', ' Booking Data Changed
        Successfully.');

        return redirect()->route('admin.categories.index')->with([
            'message' => 'Success Updated!',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        Alert::success('Deleted Successfully', ' Booking Data Changed
        Successfully.');

        return redirect()->route('admin.categories.index');
    }

    public function getData(Request $request)
{
    if ($request->ajax()) {
        $data = Category::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.categories.edit', $row->id);
                $deleteUrl = route('admin.categories.destroy', $row->id);
                $csrf = csrf_field();
                $method = method_field('DELETE');

                $actionBtn = '<div class="btn-group" role="group" aria-label="Action Buttons">';
                $actionBtn .= '<a href="' . $editUrl . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>';
                $actionBtn .= '<form class="d-inline-block" action="' . $deleteUrl . '" method="post" onsubmit="return confirm(\'Are you sure you want to delete this category?\');">';
                $actionBtn .= $csrf . $method;
                $actionBtn .= '<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>';
                $actionBtn .= '</form>';
                $actionBtn .= '</div>';

                return $actionBtn;
            })
            ->make(true);
    }

    return abort(404);
}

}
