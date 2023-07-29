<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    // Tambahkan data palsu ke tabel bookings menggunakan factory
    Booking::factory()->count(5)->create();
}
}
