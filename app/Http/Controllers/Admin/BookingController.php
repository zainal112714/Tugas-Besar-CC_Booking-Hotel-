<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GownPackage;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;
use DNS1D;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('gown_package')->paginate(10);

        // Generate the barcode for each booking
        foreach ($bookings as $booking) {
            $barcodeText = 'MarieL-' . rand(10000, 99999);
            $booking->barcodeImage = DNS1D::getBarcodePNG($barcodeText, 'C128');
        }

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

        // Generate barcode
        $barcodeText = 'MarieL-' . rand(10000, 99999); // Kode booking yang diambil dari data booking atau dapat digenerate sesuai kebutuhan
        $barcodeImage = DNS1D::getBarcodePNG($barcodeText, 'C128');

        Booking::create([
            'gown_package_id' => $request->input('gown_package_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'number_phone' => $request->input('number_phone'),
            'date' => $request->input('date'),
            'barcode' => $barcodeImage, // Simpan barcode ke dalam kolom 'barcode'
        ]);

        Alert::success('Added Successfully', 'Booking Data Added Successfully.');

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

        // Generate the barcode for the current booking
        $barcodeText = 'MarieL-' . rand(10000, 99999);
        $booking->barcodeImage = DNS1D::getBarcodePNG($barcodeText, 'C128');

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

        Alert::success('Changed Successfully', ' Update Data Successfully.');

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

        Alert::success('Deleted Successfully', ' Delete Data Successfully.');

        return redirect()->route('admin.bookings.index');
    }

    public function getData()
{
    $bookings = Booking::with('gown_package')->get();

    // Generate the barcode for each booking and store it as base64
    foreach ($bookings as $booking) {
        $barcodeText = 'MarieL-' . rand(10000, 99999);
        $barcodeImage = DNS1D::getBarcodePNG($barcodeText, 'C128');
        $booking->barcodeImage = base64_encode($barcodeImage); // Store the barcode image as base64

        // Generate WhatsApp link
        $whatsappLink = 'https://api.whatsapp.com/send?phone=' . $booking->number_phone . '&text=Halo%20[Nama Customer],%0A%0ATerima%20kasih%20telah%20melakukan%20pemesanan%20penyewaan%20baju%20pernikahan%20di%20Marie%20Location.%20Kami%20dengan%20senang%20hati%20mengkonfirmasi%20bahwa%20pesanan%20Anda%20telah%20berhasil%20tercatat.%20Berikut%20adalah%20detail%20pesanan%20Anda:%0A%0ANama%20Pemesan:%20[Nama%20Anda]%0AEmail%20Pemesan:%20[Email%20Anda]%0ANomor%20Telepon:%20[Nomor%20Anda]%0ATanggal%20Sewa:%20[Tanggal%20Sewa]%0AJenis%20Baju:%20[Jenis%20Baju%20yang%20Dipesan]%0A%0APesanan%20Anda%20akan%20segera%20kami%20proses%20dan%20kami%20akan%20memberi%20tahu%20Anda%20mengenai%20informasi%20lebih%20lanjut.%20Jika%20ada%20perubahan%20atau%20informasi%20tambahan%20yang%20perlu%20Anda%20sampaikan,%20silakan%20beri%20tahu%20kami%20secepatnya.%0A%0AJangan%20ragu%20untuk%20menghubungi%20kami%20jika%20Anda%20memiliki%20pertanyaan%20lebih%20lanjut.%20Terima%20kasih%20atas%20kepercayaan%20Anda%20pada%20layanan%20kami.%0A%0ASalam%20hangat,%0A[Tim%20Marie%20Location].';

        // Set the WhatsApp link to the booking data
        $booking->whatsappLink = $whatsappLink;
    }

    return DataTables::of($bookings)
        ->addColumn('DT_RowIndex', function ($booking) {
            return '';
        })
        ->addColumn('barcodeImage', function ($booking) {
            return '<img src="data:image/png;base64,' . $booking->barcodeImage . '" alt="Barcode">';
        })
        ->addColumn('number_phone', function ($booking) {
            return '<a href="' . $booking->whatsappLink . '" target="_blank"><i class="bi bi-whatsapp" style="color: #009d63;"></i></a>';
        })
        ->addColumn('action', function ($booking) {
            return view('admin.bookings.actions', compact('booking'));
        })
        ->rawColumns(['action', 'barcodeImage', 'number_phone'])
        ->make(true);
}



    public function exportPdf()
    {
        $bookings = Booking::all();

        // Generate the barcode for each booking
        foreach ($bookings as $booking) {
            $barcodeText = 'MarieL-' . rand(10000, 99999);
            $booking->barcodeImage = DNS1D::getBarcodePNG($barcodeText, 'C128');
        }

        // Cek apakah data booking telah berhasil diambil
        \Log::info('Data Booking:', $bookings->toArray()); // Log ke storage/logs/laravel.log

        $pdf = PDF::loadView('admin.bookings.export_pdf', compact('bookings'));

        return $pdf->download('bookings.pdf');
    }

}



