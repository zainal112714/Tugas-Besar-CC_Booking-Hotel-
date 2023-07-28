<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\GownPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'number_phone' => $this->faker->phoneNumber,
            'date' => $this->faker->date,
            'gown_package_id' => GownPackage::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}




