<?php

namespace App\Http\Controllers\Management;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EventMaterial extends Pivot
{
    protected $table = 'event_material';
}

