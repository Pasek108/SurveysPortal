<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 30; $i++) {
            DB::table('ratings')->insert([
                'user_id' => $faker->numberBetween(1, 20),
                'survey_id' => $faker->numberBetween(1, 20),
                'rating' => $faker->numberBetween(0, 5)
            ]);
        }
    }
}
