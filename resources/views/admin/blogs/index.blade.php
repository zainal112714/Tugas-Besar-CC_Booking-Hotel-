@extends('layouts.app')

@section('content')
    {{-- Content Header (Page header) --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex">
                    <h1 class="m-0">{{ __('Blog') }}</h1>
                </div>
            </div>
            <div class="d-flex justify-content-end">
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

    {{-- Main content --}}
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="blog-table" class="table table-bordered table-hover table-striped mb-0 bg-white" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Excerpt</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Data will be loaded dynamically using DataTables --}}
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="module">
    $(document).ready(function() {
        $('#blog-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.blogs.getData') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'excerpt', name: 'excerpt' },
                { data: 'category.name', name: 'category.name' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        var showUrl = "{{ route('admin.blogs.show', ':id') }}".replace(':id', full.id);
                        var editUrl = "{{ route('admin.blogs.edit', ':id') }}".replace(':id', full.id);
                        var deleteUrl = "{{ route('admin.blogs.destroy', ':id') }}".replace(':id', full.id);
                        var csrfToken = "{{ csrf_token() }}";

                        var actionButtons = '<div class="btn-group" role="group" aria-label="Action Buttons">';
                            actionButtons += '<a href="' + showUrl + '" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Show</a>';
                            actionButtons += '<a href="' + editUrl + '" class="btn btn-sm btn-info"><i class="bi bi-pencil"></i> Edit</a>';
                        actionButtons += '<form class="d-inline-block" action="' + deleteUrl + '" method="post" onsubmit="return confirm(\'Are you sure you want to delete this blog?\');">';
                        actionButtons += '<input type="hidden" name="_token" value="' + csrfToken + '">';
                        actionButtons += '<input type="hidden" name="_method" value="DELETE">';
                        actionButtons += '<button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</button>';
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
