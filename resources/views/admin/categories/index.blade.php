@extends('layouts.app')

@section('content')
    {{--  Content Header (Page header)  --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex">
                    <h1 class="m-0">{{ __('Category Blog') }}</h1>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <!-- Menggunakan class justify-content-end untuk menggeser elemen ke kanan -->
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm"> <i
                                class="fa fa-plus"></i> Add
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div><br>



    {{--  Main content  --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable"
                                id="categoryTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.categories.edit', [$category]) }}"
                                                    class="btn btn-sm btn-info"> <i class="fa fa-edit"></i> Edit </a>
                                                <form onclick="return confirm('are you sure ?');" class="d-inline-block"
                                                    action="{{ route('admin.categories.destroy', [$category]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i>
                                                        Delete
                                                    </button>
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

@push('scripts')
    <script type="module">
    $(document).ready(function() {
        $('#categoryTable').DataTable();
    });
</script>
@endpush
