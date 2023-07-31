@extends('layouts.app')

@section('content')
    {{-- <!-- Content Header (Page header) --> --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex">
                    <h1 class="m-0">{{ __('Gown Package') }}</h1>
                </div>
            </div>
            <div class="d-flex justify-content-end"> <!-- Menggunakan class justify-content-end untuk menggeser elemen ke kanan -->
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.gown_packages.create') }}" class="btn btn-primary btn-sm">
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
                        <div class="card-body p-0 table-responsive">
                            <table id="gown-package-table" class="table table-bordered table-hover table-striped mb-0 bg-white datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Type</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Image</th>
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
                                                @foreach($gown_package->galleries as $gallery)
                                                    <a href="{{ Storage::url($gallery->images) }}" target="_blank">
                                                        <img width="100" src="{{ Storage::url($gallery->images) }}" alt="{{ $gallery->name }}">
                                                    </a>
                                                @endforeach
                                            </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action Buttons">
                                                <a href="{{ route('admin.gown_packages.edit', [$gown_package]) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <form onclick="return confirm('Are you sure you want to delete this gown package?');" class="d-inline-block" action="{{ route('admin.gown_packages.destroy', [$gown_package]) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i> Delete
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
{{-- <script>
    // Inisialisasi DataTables pada tabel "gown-package-table" setelah halaman dimuat
    $(document).ready(function() {
        $('#gown-package-table').DataTable({
            // Opsi lainnya sesuai dengan kebutuhan Anda
        });
    });
</script> --}}
@push('scripts')
<script type="module">
    $(document).ready(function() {
        $('#gown-package-table').DataTable();
    });
</script>
@endpush
