<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function index(){
        $events = Events::all();
        return view('events.index', compact('events'));
    }

    public function addToCart($name)
    {
        $event = DB::table('events')->where('name', $name)->first();

        if (!$event) {
            return redirect()->back()->with('error', 'Event not found!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$event->name])) {
            return redirect()->back()->with('error', 'Event already in cart !');
        } else {
            $cart[$event->name] = [
                'name' => $event->name,
                'image' => $event->image,
                'price' => $event->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Event added to cart successfully!');
    }

    public function search(Request $request)
    {
        $search_text = $request->input('query');
        $events = Events::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('events.index', compact('events'));
    }


    public function register(Request $request, $eventId)
    {
        $user = auth()->user();
        $event = Events::findOrFail($eventId);

        if ($event->places_left <= 0) {
            return redirect()->back()->with('error', 'Event fully booked');
        }

        if ($user->event()->where('id', $eventId)->exists()) {
            return redirect()->back()->with('error', 'Already registered to event');
        }

        $user->event()->attach($event);

        $event->decrement('places_left');

        return redirect()->back()->with('success', 'Registered to the event successfully');
    }


}
