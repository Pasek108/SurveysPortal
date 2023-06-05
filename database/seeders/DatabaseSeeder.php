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
            RoleSeeder::class,
            UserSeeder::class,
            BanSeeder::class,
            TagSeeder::class,
            QuestionTypeSeeder::class,
            SurveySeeder::class,
            SurveyTagSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            UserAnswerSeeder::class,
            ReportSeeder::class,
            ContactSeeder::class,
            RatingSeeder::class
        ]);
    }
}
