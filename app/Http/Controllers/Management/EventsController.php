<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Models\Events;
use App\Models\Materials;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $events = Events::with('room')->where('user_creator', $user->id)->get();
        return view('management.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(EventStoreRequest $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $events = Events::with('room')->find($id);
        return view('management.events.index', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $event)
    {
        $user = Auth::user();

        if ($event->user_creator !== $user->id) {
            abort(403);
        }

        $event->load('room');
        $rooms = Rooms::where('availability', 1)->get();

        return view('management.events.edit', compact('event','rooms'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Events $event)
    {
        $image = $event->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($event->image);
            $image = $request->file('image')->storeAs('event', $request->file('image')->getClientOriginalName(), 'public');
        }

        $roomOption = $request->input('room_name');

        $room = Rooms::where('name', $roomOption)->first();

        $data = [
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'max_capacity' => $request->input('max_capacity'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'start_time' => $request->input('start_time'),
            'image' => $image,
            'difficulty' => $request->input('difficulty'),
            'type' => $request->input('type'),
        ];

        // Check if a room with the provided name exists
        if ($room) {
            $data['id_room'] = $room->id; // Assign the room ID to 'id_room'
        }

        if ($request->filled('end_time')) {
            $data['end_time'] = $request->input('end_time');
        }

        $event->update($data);

        return redirect()->route('management.events.index')->with('warning', 'Event updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Events $event)
    {
        $imagePath = $event->image;

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $event->delete();

        return redirect()->route('management.events.index')->with('danger', 'Event deleted successfully.');
    }

    public function search_1(Request $request)
    {
        $search_text = $request->input('query');
        $events = Events::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('management.associations.index', compact('events'));
    }

    public function search_2(Request $request)
    {
        $search_text = $request->input('query');
        $events = Events::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('management.events.index', compact('events'));
    }
}
