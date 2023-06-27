<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'description', 'price', 'quantity', 'state', 'availability', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event(){
        return $this->hasMany(Events::class);
    }

    public function events()
    {
        return $this->belongsToMany(Events::class, 'event_material', 'material_id', 'event_id');
    }

    public function decreaseCapacity()
    {
        $newCapacity = $this->max_capacity - 1;
        $this->max_capacity = max(0, $newCapacity); // Ensure the capacity is not negative
        $this->save();
    }

}