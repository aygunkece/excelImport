<?php

namespace Database\Seeders;

use App\Models\RandomUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class RandomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 500; $i++) {
            RandomUser::create([
                'name' => $faker->name,
                'phone' => $faker->numerify('##########'),
                'email' => $faker->email,
            ]);
        }
    }
}
