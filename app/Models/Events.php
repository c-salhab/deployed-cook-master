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
        'id_room'
    ];

    protected $dates = [
        'start_time'
    ];

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'id_room');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_creator');
    }

    public function material()
    {
        return $this->belongsTo(Materials::class, 'id_material');
    }

    public function decreaseCapacity()
    {
        $newCapacity = $this->max_capacity - 1;
        $this->max_capacity = max(0, $newCapacity); // Ensure the capacity is not negative
        $this->save();
    }

}
