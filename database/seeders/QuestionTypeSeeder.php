<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'text',
            'range',
            'single choice',
            'multiple choice',
            'single choice or text',
            'multiple choice or text',
        ];

        for ($i = 0; $i < count($types); $i++) DB::table('question_types')->insert(['name' => $types[$i]]);
    }
}
