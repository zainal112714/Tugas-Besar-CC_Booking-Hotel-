@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex">
                    <h1 class="m-0">{{ __('Form Create') }}</h1>
                </div>
            </div>
            <div class="d-flex justify-content-end"> <!-- Menggunakan class justify-content-end untuk menggeser elemen ke kanan -->
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div><br>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-3">
                        <form method="post" action="{{ route('admin.categories.store') }}">
                            @csrf
                            <div class="form-group row border-bottom pb-4">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="example: Gaun Mermaid, Gaun A-Line, dst">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
