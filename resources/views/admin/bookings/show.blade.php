@extends('layouts.app')

@section('content')
<div class="container-sm mt-5">
    <div class="row justify-content-center">
        <div class="p-5 bg-light rounded-3 border col-xl-6">
            <div class="mb-4 text-center">
                <h2 class="fw-bold">Booking Details</h2>
            </div>
            <hr>

            <div class="mb-3">
                <label class="form-label">Name:</label>
                <p>{{ $booking->name }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <p>{{ $booking->email }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number:</label>
                <p>{{ $booking->number_phone }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Date:</label>
                <p>{{ $booking->date }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Gown Package:</label>
                <p>{{ $booking->gown_package->type }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Barcode:</label>
                <p>
                    <img src="data:image/png;base64,{{ $booking->barcode }}" alt="Barcode">
                </p>
                <p></p>
            </div>

            <div class="mb-3">
                <label class="form-label">Barcode:</label>
                <p>
                    <img src="data:image/png;base64,{{ $booking->barcode }}" alt="Barcode">
                </p>
                <p></p>
            </div>

            <hr>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-lg w-100">
                        <i class="bi bi-arrow-left-circle me-2"></i> Back to List</a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-pencil me-2"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
