<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscription_items')->insert([
            'id' => '1',
            'description' => 'basic access to the website',
            'subscription_id' => '1',
        ]);

        DB::table('subscription_items')->insert([
            'id' => '2',
            'description' => '3 free recipes / day',
            'subscription_id' => '2',
        ]);
        DB::table('subscription_items')->insert([
            'id' => '3',
            'description' => '1 offered lesson / month',
            'subscription_id' => '2',
        ]);
        DB::table('subscription_items')->insert([
            'id' => '4',
            'description' => 'access to private messages',
            'subscription_id' => '2',
        ]);

        DB::table('subscription_items')->insert([
            'id' => '5',
            'description' => 'unlimited recipes',
            'subscription_id' => '3',
        ]);

        DB::table('subscription_items')->insert([
        'id' => '6',
        'description' => '3 offered lessons / month',
        'subscription_id' => '3',
        ]);

        DB::table('subscription_items')->insert([
            'id' => '7',
            'description' => '1 free formation / month',
            'subscription_id' => '3',
        ]);
        DB::table('subscription_items')->insert([
            'id' => '8',
            'description' => 'access to private messages',
            'subscription_id' => '3',
        ]);

        DB::table('subscription_items')->insert([
            'id' => '9',
            'description' => 'no ads',
            'subscription_id' => '3',
        ]);

        DB::table('subscription_items')->insert([
            'id' => '10',
            'description' => 'ads',
            'subscription_id' => '1',
        ]);

        DB::table('subscription_items')->insert([
            'id' => '11',
            'description' => 'ads only on videos',
            'subscription_id' => '2',
        ]);
    }
}
