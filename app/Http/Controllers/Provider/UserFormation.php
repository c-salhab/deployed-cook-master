<?php

namespace App\Http\Controllers\Provider;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserFormation extends Pivot
{
    protected $table = 'user_formation';
}

