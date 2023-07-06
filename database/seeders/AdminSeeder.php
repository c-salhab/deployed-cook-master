<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Team;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscriptions')->insert([
            'id' => '1',
            'name' => 'Free',
            'price' => '0',
            'currency' => 'eur',
            'product_id' => null,
            'price_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'yourcookmaster@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('2x4vjU6rFRpVXneg'),
            'role' => 'super administrator',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Team::create(
            [
                'user_id' => 1,
                'name' => 'Administrator\'s team',
                'personal_team' => true
            ]
        );

        DB::table('users')->insert([
            'name' => 'Teddy',
            'email' => 'truongteddy306@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Teddy123'),
            'role' => 'administrator',
            'subscription_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Team::create(
            [
                'user_id' => 2,
                'name' => 'Teddy\'s team',
                'personal_team' => true
            ]
        );

        DB::table('users')->insert([
            'name' => 'Charbel',
            'email' => 'charbel123@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Charbel123'),
            'role' => 'administrator',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Team::create(
            [
                'user_id' => 3,
                'name' => 'Charbel\'s team',
                'personal_team' => true
            ]
        );

        DB::table('users')->insert([
            'name' => 'Quang',
            'email' => 'quang123@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Quang123'),
            'role' => 'administrator',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Team::create(
            [
                'user_id' => 4,
                'name' => 'Quang\'s team',
                'personal_team' => true
            ]
        );
    }
}
