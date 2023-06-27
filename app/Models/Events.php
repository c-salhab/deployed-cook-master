<?php

namespace App\Models;

use App\Http\Controllers\Management\EventMaterial;
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

    public function materials()
    {
        return $this->belongsToMany(Materials::class, 'event_material', 'event_id', 'material_id');
    }
    public function decreaseCapacity()
    {
        $newCapacity = $this->max_capacity - 1;
        $this->max_capacity = max(0, $newCapacity); // Ensure the capacity is not negative
        $this->save();
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists, $using = null)
    {
        if ($using === null && $table === 'event_material') {
            return EventMaterial::fromRawAttributes($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists, $using);
    }

    public function material()
    {
        return $this->belongsToMany(Materials::class, 'event_material', 'event_id', 'material_id')
            ->using(EventMaterial::class)
            ->withPivot('quantity');
    }



}
