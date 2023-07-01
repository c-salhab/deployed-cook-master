<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'description', 'price', 'duration', 'score', 'creation_date', 'creator'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessons(){
        return $this->hasMany(Lessons::class);
    }

}