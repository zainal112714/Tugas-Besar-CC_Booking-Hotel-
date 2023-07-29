@extends('layouts.app')

@section('content')
<div class="container-sm mt-5">
    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 border col-xl-6">
                <div class="mb-4 text-center">
                    <h2 class="fw-bold">Edit Booking</h2>
                </div>
                <hr>

                <div class="mb-3">
                    <label for="gown_package_id" class="form-label">Select Gown Package</label>
                    <select class="form-select @error('gown_package_id') is-invalid @enderror"
                        name="gown_package_id" id="gown_package_id">
                        <option value="">Select Gown Package</option>
                        @foreach ($gown_packages as $gown_package)
                        <option value="{{ $gown_package->id }}"
                            {{ $booking->gown_package_id == $gown_package->id ? 'selected' : '' }}>
                            {{ $gown_package->type }}</option>
                        @endforeach
                    </select>
                    @error('gown_package_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                            id="name" value="{{ $booking->name }}" placeholder="Enter Name">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                            id="email" value="{{ $booking->email }}" placeholder="Enter Email">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="number_phone" class="form-label">Phone Number</label>
                        <input class="form-control @error('number_phone') is-invalid @enderror" type="text"
                            name="number_phone" id="number_phone" value="{{ $booking->number_phone }}"
                            placeholder="Enter Phone Number">
                        @error('number_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input class="form-control @error('date') is-invalid @enderror" type="date" name="date"
                            id="date" value="{{ $booking->date }}">
                        @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-lg w-100">
                            <i class="bi bi-arrow-left-circle me-2"></i> Cancel</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-lg w-100"><i class="bi bi-check-circle me-2"></i>
                            Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
