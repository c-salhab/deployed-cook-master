<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalProduct extends Model
{
    protected $table = 'rental_product';
    protected $fillable = ['rental_id', 'material_id', 'quantity'];

    public function rental()
    {
        return $this->belongsTo(Rentals::class, 'rental_id');
    }

    public function material()
    {
        return $this->belongsTo(Materials::class, 'material_id');
    }
}
