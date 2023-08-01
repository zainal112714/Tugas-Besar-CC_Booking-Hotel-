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
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable"
                                id="categoryTable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
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
<script type="module">
    $(document).ready(function() {
        $('#categoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.categories.getData') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        var editUrl = "{{ route('admin.categories.edit', ':id') }}".replace(':id', full.id);
                        var deleteUrl = "{{ route('admin.categories.destroy', ':id') }}".replace(':id', full.id);
                        var csrfToken = "{{ csrf_token() }}";

                        var actionButtons = '<div class="btn-group" role="group" aria-label="Action Buttons">';
                        actionButtons += '<a href="' + editUrl + '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>';
                        actionButtons += '<form class="d-inline-block" action="' + deleteUrl + '" method="post" onsubmit="return confirm(\'Are you sure you want to delete this category?\');">';
                        actionButtons += '<input type="hidden" name="_token" value="' + csrfToken + '">';
                        actionButtons += '<input type="hidden" name="_method" value="DELETE">';
                        actionButtons += '<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>';
                        actionButtons += '</form>';
                        actionButtons += '</div>';

                        return actionButtons;
                    }
                }
            ]
        });
    });
</script>
@endpush
