<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Support\Facades\Auth;

class JoinedEventsController
{
    public function index()
    {
        $user = auth()->user();
        $eventIds = $user->event()->pluck('id');

        $events = Events::whereIn('id', $eventIds)->get();

        return view('billing.events.index', compact('events'));
    }

}
