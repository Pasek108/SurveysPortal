<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['owner', 'admin', 'moderator', 'user'];
        $number_of_users = [1, 2, 4, 13];

        for ($i = 0; $i < count($roles); $i++) {
            for ($j = 0; $j < $number_of_users[$i]; $j++) {
                DB::table('users')->insert([
                    'name' => $roles[$i] . ($j + 1),
                    'email' => $roles[$i] . ($j + 1) . '@mail.com',
                    'email_verified_at' => '2023-05-27 16:17:45',
                    'password' => Hash::make('password'),
                    'role_id' => $i + 1
                ]);
            }
        }
    }
}
