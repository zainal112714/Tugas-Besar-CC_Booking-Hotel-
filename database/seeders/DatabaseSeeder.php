<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            BookingSeeder::class, // Memanggil seeder
            GownPackageSeeder::class, // Memanggil seeder
            GallerySeeder::class, // Memanggil seeder
            AdminSeeder::class // Memanggil seeder AdminSeeder
        ]);
    }
}
