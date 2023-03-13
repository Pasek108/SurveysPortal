<?php

namespace Database\Seeders;

use App\Models\Answers;
use App\Models\Questions;
use App\Models\Surveys;
use App\Models\Tags;
use App\Models\Users;
use App\Models\SurveysTags;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Users::factory(20)->create();
        Tags::factory(20)->create();
        Surveys::factory(20)->create();
        Questions::factory(20)->create();
        Answers::factory(20)->create();
        SurveysTags::factory(20)->create();
    }
}
