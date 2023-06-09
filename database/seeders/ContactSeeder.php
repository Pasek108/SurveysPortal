<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('contact')->insert([
                'email' => $faker->email(),
                'message' => $faker->paragraph(4),
                'read' => $faker->boolean()
            ]);
        }
    }
}
