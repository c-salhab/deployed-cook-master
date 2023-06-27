<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'description', 'price', 'address', 'max_capacity', 'availability', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events(){
        return $this->hasMany(Events::class);
    }

}