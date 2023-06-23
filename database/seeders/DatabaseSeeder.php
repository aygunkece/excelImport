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
       /*  \App\Models\RandomUser::factory(5000)->create();

         \App\Models\RandomUser::factory()->create([
             'name' => fake()->name(),
             'email' => fake()->unique()->safeEmail(),
             'phone' => fake()->phoneNumber(),
        ]);*/
        $this->call([
            RandomUserSeeder::class,
        ]);

    }
}
