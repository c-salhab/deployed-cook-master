<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'name', 'description', 'price', 'duration', 'state', 'score', 'creator'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certification()
    {
        return $this->belongsTo(Certification::class, 'certification_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

}