<?php

namespace Database\Factories;

use App\Models\GownPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GownPackage>
 */
class GownPackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GownPackage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['ballgown', 'mermaid', 'A-line']),
            'slug' => $this->faker->unique()->slug,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'price' => $this->faker->numberBetween(1000, 5000),
            'description' => $this->faker->paragraph,
        ];
    }
}
