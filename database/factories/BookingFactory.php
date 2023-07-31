<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\GownPackage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Milon\Barcode\DNS1D;

class BookingFactory extends Factory
{
    // ...

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $barcodeText = 'MarieL-' . rand(10000, 99999);
        $barcodeImage = DNS1D::getBarcodePNG($barcodeText, 'C128');

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'number_phone' => $this->faker->phoneNumber,
            'date' => $this->faker->date,
            'gown_package_id' => GownPackage::factory()->create()->id,
            'barcode' => $barcodeImage,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}






