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
            'name' => 'Free plan',
            'price' => '0',
            'currency' => 'eur',
            'product_id' => null,
            'price_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Super Administrator',
            'first_name' => 'Super',
            'last_name' => 'Administrator',
            'email' => 'cookmaster@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Cook123'),
            'role' => 'super administrator',
            'customer_id' => 'cus_OECqVZY4CiKFJn',
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
            'first_name' => 'Teddy',
            'last_name' => 'T',
            'email' => 'teddy@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Teddy123'),
            'role' => 'administrator',
            'customer_id' => 'cus_OECptTFNH1UGGV',
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
            'first_name' => 'Charbel',
            'last_name' => 'S',
            'email' => 'charbel@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Charbel123'),
            'role' => 'administrator',
            'customer_id' => 'cus_OECq4Gg2AMQl2l',
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
            'first_name' => 'Quang',
            'last_name' => 'L',
            'email' => 'Quang@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Quang123'),
            'role' => 'administrator',
            'customer_id' => 'cus_OECqXLH5Pc7git',
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


        DB::table('users')->insert([
            'name' => 'Cedric Grelet',
            'first_name' => 'Cedric',
            'last_name' => 'Grolett',
            'email' => 'cgrolet@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Cedric123'),
            'role' => 'provider',
            'customer_id' => 'cus_OFeff5AEZbSZwB',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Team::create(
            [
                'user_id' => 5,
                'name' => 'Cedric\'s team',
                'personal_team' => true
            ]
        );

        DB::table('users')->insert([
            'name' => 'Alain Ducasse',
            'first_name' => 'Alain',
            'last_name' => 'Ducasse',
            'email' => 'aducasse@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Alain123'),
            'role' => 'provider',
            'customer_id' => 'cus_OFefOhqav63L0Z',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Team::create(
            [
                'user_id' => 6,
                'name' => 'Alain\'s team',
                'personal_team' => true
            ]
        );


        DB::table('users')->insert([
            'name' => 'Philippe Etchebest',
            'first_name' => 'Philippe',
            'last_name' => 'Etchebest',
            'email' => 'petchebest@protonmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Philippe123'),
            'role' => 'provider',
            'customer_id' => 'cus_OFehLRYBtffV7O',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Team::create(
            [
                'user_id' => 7,
                'name' => 'Philippe\'s team',
                'personal_team' => true
            ]
        );
    }
}
