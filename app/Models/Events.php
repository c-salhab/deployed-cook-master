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

    public function decreaseCapacity()
    {
        $newCapacity = $this->max_capacity - 1;
        $this->max_capacity = max(0, $newCapacity); // Ensure the capacity is not negative
        $this->save();
    }

}
