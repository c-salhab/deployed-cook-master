<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'yourcookmaster@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('2x4vjU6rFRpVXneg'),
            'role' => 'super administrator',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Teddy',
            'email' => 'truongteddy306@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Teddy123'),
            'role' => 'administrator',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Charbel',
            'email' => 'charbel123@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Charbel123'),
            'role' => 'administrator',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Quang',
            'email' => 'quang123@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Quang123'),
            'role' => 'administrator',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
