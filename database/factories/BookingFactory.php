<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'customer_name' => $this->faker->name,
            'date' => $this->faker->date,
            'gown_package_id' => \App\Models\GownPackage::factory(), // jika ada relasi
            // tambahkan kolom lain sesuai kebutuhan
        ];
    }
}
