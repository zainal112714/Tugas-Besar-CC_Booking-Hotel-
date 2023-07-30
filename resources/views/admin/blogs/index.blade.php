@extends('layouts.app')

@section('content')
    {{-- <!-- Content Header (Page header) --> --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex">
                    <h1 class="m-0">{{ __('Blog') }}</h1>
                </div>
            </div>
            <div class="d-flex justify-content-end"> <!-- Menggunakan class justify-content-end untuk menggeser elemen ke kanan -->
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus"></i> Add
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div><br>


    {{-- <!-- Main content --> --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <table id="blog-table" class="table table-bordered table-hover table-striped mb-0 bg-white datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Excerpt</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>
                                                <a href="{{ Storage::url($blog->image) }}" target="_blank">
                                                    <img src="{{ Storage::url($blog->image) }}" width="100" alt="">
                                                </a>
                                            </td>
                                            <td>{{ $blog->excerpt }}</td>
                                            <td>{{ $blog->category->name }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action Buttons">
                                                    <a href="{{ route('admin.blogs.edit', [$blog]) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form onclick="return confirm('Are you sure you want to delete this blog?');" class="d-inline-block" action="{{ route('admin.blogs.destroy', [$blog]) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
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

@push('scripts')
<script type="module">
    $(document).ready(function() {
        $('#blog-table').DataTable();
    });
</script>
@endpush
