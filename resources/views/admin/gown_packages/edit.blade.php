@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">{{ __('Form Edit') }}</h1>
                    <a href="{{ route('admin.gown_packages.index') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> </a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Images</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($gown_package->galleries as $gallery)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $gallery->name }}</td>
                                        <td>
                                            <a href="{{ Storage::url($gallery->images) }}" target="_blank">
                                                <img width="100" src="{{ Storage::url($gallery->images) }}" alt="{{ $gallery->name }}">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.gown_packages.galleries.edit', [$gown_package,$gallery]) }}" class="btn btn-sm btn-info"> <i class="fa fa-edit"></i> </a>
                                            <form onclick="return confirm('are you sure ?');" class="d-inline-block" action="{{ route('admin.gown_packages.galleries.destroy', [$gown_package,$gallery]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">Gallery Kosong</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 py-1">
                    <div class="card p-3">
                        <form method="post" action="{{ route('admin.gown_packages.galleries.store', [$gown_package]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row border-bottom pb-4">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="example: Dress">
                                </div>
                            </div>

                            <div class="form-group row border-bottom pb-4">
                                <label for="images" class="col-sm-2 col-form-label">Images</label>
                                <div class="col-sm-10">
                                <input type="file" class="form-control" name="images" value="{{ old('images') }}" id="images">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div><br>

                    <div class="card p-3">
                        <form method="post" action="{{ route('admin.gown_packages.update', [$gown_package]) }}">
                            @csrf
                            @method('put')
                            <div class="form-group row border-bottom pb-4">
                                <label for="type" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="type" value="{{ old('type', $gown_package->type) }}" id="type" placeholder="example: 4D5N">
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="Size" class="col-sm-2 col-form-label">Size</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="Size" name="size">
                                        <option value="" disabled selected style="display:none;">Select Size</option>
                                        <option value="XL"{{ $gown_package->size === 'XL' ? ' selected' : '' }}>XL</option>
                                        <option value="L"{{ $gown_package->size === 'L' ? ' selected' : '' }}>L</option>
                                        <option value="M"{{ $gown_package->size === 'M' ? ' selected' : '' }}>M</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="price" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                <input text="number" class="form-control" id="price" name="price" value="{{ old('price', $gown_package->price) }}" placeholder="example: 300">
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" name="type" id="description" cols="30" rows="7" placeholder="Description text...">{{ old('description', $gown_package->description) }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection


@section('styles')
<style>
.ck-editor__editable_inline {
    min-height: 200px;
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
