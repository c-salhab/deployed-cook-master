<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('subscriptions')->insert([
            'id' => '1',
            'name' => 'Standard',
            'price' => '15',
            'currency' => 'eur',
            'product_id' => 'prod_O82R0hvnqTGZkn',
            'price_id' => 'price_1NLmMCFWvpUMtb2u5DAtgqkf',
            'created_at' => now(),
            'updated_at' => now()

        ]);

        DB::table('subscriptions')->insert([
            'id' => '2',
            'name' => 'Master',
            'price' => '30',
            'currency' => 'eur',
            'product_id' => 'prod_O999xWv53SzG3l',
            'price_id' => 'price_1NMqrTFWvpUMtb2uWayx5fPr',
            'created_at' => now(),
            'updated_at' => now()
       ]);
    }
}
