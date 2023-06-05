<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bans')->insert(['user_id' => 5, 'reason' => 'Reason 1', 'end_date' => '2023-05-27 16:17:45']);
        DB::table('bans')->insert(['user_id' => 7, 'reason' => 'Reason 2', 'end_date' => '2024-05-27 16:17:45']);
    }
}
