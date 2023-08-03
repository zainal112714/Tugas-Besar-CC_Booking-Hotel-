@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 justify-content-between d-flex">
                    <h1 class="m-0">{{ __('Booking') }}</h1>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.bookings.exportPdf') }}" class="btn btn-outline-danger">
                            <i class="bi bi-download me-1"></i> to PDF
                        </a>
                    </li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item">
                        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus"></i> Add Booking
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div><br>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0 table-responsive">
                            <table id="booking-table" class="table table-bordered table-hover table-striped mb-0 bg-white" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number Phone</th>
                                        <th>Date</th>
                                        <th>Gown Package</th>
                                        {{-- <th>Barcode</th> --}}
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
<script type="module">
    $(document).ready(function () {
        $('#booking-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.bookings.getData') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false,
                    render: function (data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'number_phone', name: 'number_phone',
                    render: function (data, type, full, meta) {
                        return '<a href="' + full.whatsappLink + '" target="_blank"><i class="bi bi-whatsapp" style="color: #009d63; text-align: center;"></i></a>';
                    }
                },
                { data: 'date', name: 'date' },
                { data: 'gown_package.type', name: 'gown_package.type' },
                // { data: 'barcodeImage', name: 'barcodeImage', orderable: false, searchable: false,
                //     render: function (data, type, full, meta) {
                //         return '<img src="data:image/png;base64,' + data + '" alt="Barcode">';
                //     }
                // },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
