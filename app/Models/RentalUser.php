<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalUser extends Model
{
    protected $table = 'rentals_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rental()
    {
        return $this->belongsTo(Rentals::class);
    }
}

