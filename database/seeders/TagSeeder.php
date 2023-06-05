<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'nature',
            'cats',
            'dogs',
            'animals',
            'cooking',
            'food',
            'technology',
            'humour',
            'test',
            'anime',
            'film',
            'movie',
            'science',
            'books',
            'art',
            'love',
        ];

        for ($i = 0; $i < count($tags); $i++) DB::table('tags')->insert(['name' => $tags[$i]]);
    }
}
