<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GownPackage;
use PDF;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('gown_package')->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gown_packages = GownPackage::all();
        return view('admin.bookings.create', compact('gown_packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gown_package_id' => 'required|exists:gown_packages,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'number_phone' => 'required',
            'date' => 'required|date',
        ], [
            'gown_package_id.required' => 'Paket Gaun harus diisi.',
            'gown_package_id.exists' => 'Paket Gaun yang dipilih tidak valid.',
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'number_phone.required' => 'Nomor telepon harus diisi.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal harus berupa format tanggal yang valid.',
        ]);

        Booking::create([
            'gown_package_id' => $request->input('gown_package_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'number_phone' => $request->input('number_phone'),
            'date' => $request->input('date'),
        ]);

        return redirect()->route('admin.bookings.index')->with([
            'message' => 'Pemesanan berhasil dibuat!',
            'alert-type' => 'success'
        ]);
    }

    /**
    * Display the specified resource.
    */
    public function show(string $id)
    {
        $booking = Booking::findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        $gown_packages = GownPackage::all();

        return view('admin.bookings.edit', compact('booking', 'gown_packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'gown_package_id' => 'required|exists:gown_packages,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'number_phone' => 'required',
            'date' => 'required|date',
        ], [
            'gown_package_id.required' => 'Paket Gaun harus diisi.',
            'gown_package_id.exists' => 'Paket Gaun yang dipilih tidak valid.',
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'number_phone.required' => 'Nomor telepon harus diisi.',
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Tanggal harus berupa format tanggal yang valid.',
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update([
            'gown_package_id' => $request->input('gown_package_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'number_phone' => $request->input('number_phone'),
            'date' => $request->input('date'),
        ]);

        return redirect()->route('admin.bookings.index')->with([
            'message' => 'Pemesanan berhasil diperbarui!',
            'alert-type' => 'success'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with([
            'message' => 'Pemesanan berhasil dihapus!',
            'alert-type' => 'danger'
        ]);
    }

    public function exportPdf()
    {
        $bookings = Booking::all();

        // Cek apakah data booking telah berhasil diambil
        \Log::info('Data Booking:', $bookings->toArray()); // Log ke storage/logs/laravel.log

        $pdf = PDF::loadView('admin.bookings.export_pdf', compact('bookings'));

        return $pdf->download('bookings.pdf');
    }

}



