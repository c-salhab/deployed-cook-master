<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'user_id',
        'address',
        'max_capacity',
        'start_time',
        'end_time',
    ];
}
