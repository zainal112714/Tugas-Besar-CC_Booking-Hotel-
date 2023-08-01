@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex">
                    <h1 class="m-0">{{ __('Gown Package Details') }}</h1>
                </div>
            </div>
        </div>
    </div><br>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $gown_package->type }}</h5>
                            <p class="card-text"><strong>Size:</strong> {{ $gown_package->size }}</p>
                            <p class="card-text"><strong>Price:</strong> {{ $gown_package->price }}</p>
                            <p class="card-text"><strong>Description:</strong> {{ $gown_package->description }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.gown_packages.index') }}" class="btn btn-secondary mt-3">
                        <i class="fa fa-arrow-left"></i> Back to Index
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Gown Package Image(s)</h5>
                            @php
                                $galleries = $gown_package->galleries;
                                $grouped_galleries = $galleries->chunk(3);
                            @endphp

                            @foreach ($grouped_galleries as $gallery_group)
                                <div class="row mb-3">
                                    @foreach ($gallery_group as $gallery)
                                        <div class="col-4">
                                            <a href="{{ Storage::url($gallery->images) }}" target="_blank">
                                                <img src="{{ Storage::url($gallery->images) }}" alt="{{ $gallery->name }}" class="img-thumbnail mb-2" style="max-height: 200px; max-width: 100%;">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
