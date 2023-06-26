<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('reports')->insert([
                'user_id' => $faker->numberBetween(1, 20),
                'survey_id' => $faker->numberBetween(1, 20),
                'reason' => $faker->paragraph(4),
                'read' => $faker->boolean()
            ]);
        }
    }
}
