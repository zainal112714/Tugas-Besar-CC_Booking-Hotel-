<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DNS1D;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Mendefinisikan pesan kesalahan untuk validasi input
        $messages = [
            'required' => ':attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar.',
            'numeric' => ':attribute harus berupa angka.',
            'date' => ':attribute harus berupa tanggal.',
        ];

        // Mendefinisikan atribut untuk pesan kesalahan
        $attributes = [
            'name' => 'Nama',
            'email' => 'Email',
            'number_phone' => 'Nomor Telepon',
            'date' => 'Tanggal',
        ];

        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'number_phone' => 'required|numeric',
            'date' => 'required|date',
        ], $messages);

        // Menggunakan atribut untuk pesan kesalahan
        $validator->setAttributeNames($attributes);

        // Jika terdapat kesalahan validasi, kembalikan kembali ke halaman sebelumnya dengan pesan kesalahan dan input yang diisi sebelumnya
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate barcode
        $barcodeText = 'MarieL-' . rand(10000, 99999); // Kode booking yang diambil dari data booking atau dapat digenerate sesuai kebutuhan
        $barcodeImage = DNS1D::getBarcodePNG($barcodeText, 'C128');

        // Jika validasi berhasil, simpan data ke database
        Booking::create([
            'gown_package_id' => $request->input('gown_package_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'number_phone' => $request->input('number_phone'),
            'date' => $request->input('date'),
            'barcode' => $barcodeImage, // Simpan barcode ke dalam kolom 'barcode'
        ]);

        return redirect()->back()->with([
            'message' => "Berhasil, kami akan memproses pemesanan Anda silahkan menunggu WA dari admin, Terimakasih."
        ]);
    }

}
