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
            'description' => '3 free recipes per day',
            'subscription_id' => '1',
        ]);
        DB::table('subscription_items')->insert([
            'id' => '2',
            'description' => '1 free formation per month',
            'subscription_id' => '1',
        ]);
        DB::table('subscription_items')->insert([
            'id' => '3',
            'description' => 'private message with a chief',
            'subscription_id' => '1',
        ]);

        DB::table('subscription_items')->insert([
            'id' => '4',
            'description' => 'unlimited recipes',
            'subscription_id' => '2',
        ]);
        DB::table('subscription_items')->insert([
            'id' => '5',
            'description' => '3 free formations per month',
            'subscription_id' => '2',
        ]);
        DB::table('subscription_items')->insert([
            'id' => '6',
            'description' => 'private message with a chief',
            'subscription_id' => '2',
        ]);

        DB::table('subscription_items')->insert([
            'id' => '7',
            'description' => '20% reduction on extra recipes',
            'subscription_id' => '2',
        ]);
    }
}
