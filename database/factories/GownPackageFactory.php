<?php

namespace Database\Factories;

use App\Models\GownPackage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

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
        $faker = FakerFactory::create('id_ID'); // Indonesian language
        return [
            'type' => $faker->randomElement(['ballgown', 'mermaid', 'A-line']),
            'slug' => $faker->unique()->slug,
            'size' => $faker->randomElement(['S', 'M', 'L', 'XL']),
            'price' => $faker->numberBetween(1000, 5000),
            'description' => $faker->paragraph,
        ];
    }
}
