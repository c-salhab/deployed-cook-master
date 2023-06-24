<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'max_capacity',
        'description',
        'price',
        'difficulty',
        'type',
        'start_time',
        'end_time',
        'image',
        'user_creator',
    ];

    protected $dates = [
        'start_time'
    ];

    public function rooms(){
        return $this->belongsTo(Rooms::class);
    }

    public function decreaseCapacity()
    {
        $newCapacity = $this->max_capacity - 1;
        $this->max_capacity = max(0, $newCapacity); // Ensure the capacity is not negative
        $this->save();
    }

}
