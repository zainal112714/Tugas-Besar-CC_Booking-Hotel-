@extends('layouts.app')

@section('content')
    {{-- <!-- Content Header (Page header) --> --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex">
                    <h1 class="m-0">{{ __('Gown Package') }}</h1>
                    <a href="{{ route('admin.Gown_packages.create') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> </a>
                </div>
            </div>
        </div><
    </div>
    {{-- <!-- /.content-header --> --}}

    {{-- <!-- Main content --> --}}
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
                                        <th>Type</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($gown_packages as $gown_package)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $gown_package->type }}</td>
                                        <td>{{ $gown_package->size }}</td>
                                        <td>{{ $gown_package->price }}</td>
                                        <td>
                                            <a href="{{ route('admin.gown_packages.edit', [$gown_package]) }}" class="btn btn-sm btn-info"> <i class="fa fa-edit"></i> </a>
                                            <form onclick="return confirm('are you sure ?');" class="d-inline-block" action="{{ route('admin.gown_packages.destroy', [$gown_package]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
