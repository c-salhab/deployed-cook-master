<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'quantity', 'state', 'image', 'description', 'start_time', 'end_time', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function decreaseQuantity($quantity)
    {
        $newQuantity = $this->quantity - $quantity;
        $this->quantity = max(0, $newQuantity); // Ensure the quantity is not negative
        $this->save();
    }

}