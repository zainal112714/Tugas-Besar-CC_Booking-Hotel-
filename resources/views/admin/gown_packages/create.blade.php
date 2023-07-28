@extends('layouts.app')

@section('content')
    {{-- <!-- Content Header (Page header) --> --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">{{ __('Form Create') }}</h1>
                    <a href="{{ route('admin.gown_packages.index') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> </a>
                </div>
            </div>
        </div>
    </div>
    {{-- <!-- /.content-header --> --}}

    {{-- <!-- Main content --> --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-3">
                        <form method="post" action="{{ route('admin.gown_packages.store') }}">
                            @csrf
                            <div class="form-group row border-bottom pb-4">
                                <label for="type" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" id="type" placeholder="example: Gaun/Dress">
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="Size" class="col-sm-2 col-form-label">Size</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('size') is-invalid @enderror" id="Size" name="size">
                                        <option value="" disabled selected style="display:none;">Select Size</option>
                                        <option value="XL" @if(old('size') == 'XL') selected @endif>XL</option>
                                        <option value="L" @if(old('size') == 'L') selected @endif>L</option>
                                        <option value="M" @if(old('size') == 'M') selected @endif>M</option>
                                        <option value="M" @if(old('size') == 'S') selected @endif>M</option>
                                    </select>
                                    @error('size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="price" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="example: 300">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="7" placeholder="Description text...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><
    </div>
    {{-- <!-- /.content --> --}}
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
