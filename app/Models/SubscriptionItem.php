<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubscriptionItem extends Model
{
    use HasFactory;

    public function create($advantage, $id){
        DB::table('subscription_items')->insert(
            [
                'description' => $advantage,
                'subscription_id' => $id,
            ]
        );
    }
}
