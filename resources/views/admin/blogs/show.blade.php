@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex">
                    <h1 class="m-0">{{ __('Blog Details') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text"><strong>Category:</strong> {{ $blog->category->name }}</p>
                            <p class="card-text"><strong>Excerpt:</strong> {{ $blog->excerpt }}</p>
                            <p class="card-text"><strong>Description:</strong> {{ $blog->description }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary mt-3">
                        <i class="bi bi-arrow-left"></i> Back to Index
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Blog Image</h5>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ asset(Storage::url($blog->image)) }}" target="_blank">
                                        <img src="{{ asset(Storage::url($blog->image)) }}" alt="{{ $blog->title }}" class="img-thumbnail mb-2" style="max-height: 100px; max-width: 100%;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
