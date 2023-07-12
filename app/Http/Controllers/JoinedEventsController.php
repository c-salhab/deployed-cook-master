<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
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

    public function search(Request $request)
    {
        $search_text = $request->input('query');

        $user = auth()->user();
        $events = $user->event()->where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('billing.events.index', compact('events'));
    }


}
