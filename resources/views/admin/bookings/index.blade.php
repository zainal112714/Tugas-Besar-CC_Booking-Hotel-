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
            <div class="d-flex justify-content-end"> <!-- Menggunakan class justify-content-end untuk menggeser elemen ke kanan -->
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

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <table id="booking-table" class="table table-bordered table-hover table-striped mb-0 bg-white datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number Phone</th>
                                        <th>Date</th>
                                        <th>Gown Package</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $booking->name }}</td>
                                            <td>{{ $booking->email }}</td>
                                            <td style="text-align: center;">
                                                <a href="https://api.whatsapp.com/send?phone={{ $booking->number_phone }}&text=Halo [Nama Customer],%0A%0ATerima%20kasih%20telah%20melakukan%20pemesanan%20penyewaan%20baju%20pernikahan%20di%20Marie%20Location.%20Kami%20dengan%20senang%20hati%20mengkonfirmasi%20bahwa%20pesanan%20Anda%20telah%20berhasil%20tercatat.%20Berikut%20adalah%20detail%20pesanan%20Anda:%0A%0ANama%20Pemesan:%20[Nama%20Anda]%0AEmail%20Pemesan:%20[Email%20Anda]%0ANomor%20Telepon:%20[Nomor%20Anda]%0ATanggal%20Sewa:%20[Tanggal%20Sewa]%0AJenis%20Baju:%20[Jenis%20Baju%20yang%20Dipesan]%0A%0APesanan%20Anda%20akan%20segera%20kami%20proses%20dan%20kami%20akan%20memberi%20tahu%20Anda%20mengenai%20informasi%20lebih%20lanjut.%20Jika%20ada%20perubahan%20atau%20informasi%20tambahan%20yang%20perlu%20Anda%20sampaikan,%20silakan%20beri%20tahu%20kami%20secepatnya.%0A%0AJangan%20ragu%20untuk%20menghubungi%20kami%20jika%20Anda%20memiliki%20pertanyaan%20lebih%20lanjut.%20Terima%20kasih%20atas%20kepercayaan%20Anda%20pada%20layanan%20kami.%0A%0ASalam%20hangat,%0A[Tim%20Marie%20Location].">
                                                    <i class="bi bi-whatsapp" style="color: #009d63;"></i>
                                                </a>
                                            </td>
                                            <td>{{ $booking->date }}</td>
                                            <td>{{ $booking->gown_package->size }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Action Buttons">
                                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i> Show
                                                    </a>
                                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form onclick="return confirm('Are you sure you want to delete this booking?');" class="d-inline-block" action="{{ route('admin.bookings.destroy', $booking->id) }}" method="post">
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
        $('#booking-table').DataTable();
    });
</script>
@endpush
