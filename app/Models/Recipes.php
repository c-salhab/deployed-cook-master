<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'steps','creator', 'duration','difficulty','quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipes(){
        return $this->hasMany(Recipes::class);
    }

}