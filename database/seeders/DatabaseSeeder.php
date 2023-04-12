<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Ban;
use App\Models\Contact;
use App\Models\Question;
use App\Models\Report;
use App\Models\Survey;
use App\Models\SurveyTag;
use App\Models\Tag;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();
        Tag::factory(20)->create();
        Survey::factory(20)->create();
        Question::factory(20)->create();
        Answer::factory(20)->create();
        SurveyTag::factory(20)->create();
        Contact::factory(12)->create();
        Ban::factory(4)->create();
        Report::factory(6)->create();
    }
}
