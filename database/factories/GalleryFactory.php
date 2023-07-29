<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imagePath = UploadedFile::fake()->image('gallery', 640, 480);

        return [
            'name' => $this->faker->word,
            'images' => 'gown_package/gallery/' . $imagePath->hashName(),
            'gown_package_id' => \App\Models\GownPackage::factory(),
        ];
    }
}
