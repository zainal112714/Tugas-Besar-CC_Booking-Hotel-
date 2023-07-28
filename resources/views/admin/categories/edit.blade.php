@extends('layouts.app')

@section('content')
    {{-- <!-- Content Header (Page header) --> --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1 class="m-0">{{ __('Form Edit') }}</h1>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> </a>
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
                        <form method="post" action="{{ route('admin.categories.update', [$category]) }}">
                            @csrf
                            @method('put')
                            <div class="form-group row bottom pb-4 ">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $category->name) }}" id="name" placeholder="example: Bali">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success ">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
