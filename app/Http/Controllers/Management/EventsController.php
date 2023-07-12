<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Models\Events;
use App\Models\Materials;
use App\Models\Rooms;
use App\Notifications\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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
        $materials = Materials::where('availability', 1)->get();

        return view('management.events.edit', compact('event', 'rooms', 'materials'));
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

        $room = Rooms::where('id', $roomOption)->first();

        $data = [
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'max_capacity' => $request->input('max_capacity'),
            'places_left' => $request->input('max_capacity'),
            'description' => $request->input('description'),
            'start_time' => $request->input('start_time'),
            'image' => $image,
            'difficulty' => $request->input('difficulty'),
            'type' => $request->input('type'),
        ];


        if ($room) {
            $data['id_room'] = $room->id;
        }

        if ($request->filled('end_time')) {
            $data['end_time'] = $request->input('end_time');
        }


        $event->update($data);

        $validated = $request->validate([
            'material_name' => ['nullable', 'array'],
            'material_name.*' => ['nullable', 'exists:materials,id'],
            'quantity' => ['nullable', 'array'],
            'quantity.*' => ['nullable', 'integer', 'min:0'],
        ]);

        $selectedMaterials = $validated['material_name'] ?? [];
        $quantities = $validated['quantity'] ?? [];

        $event->materials()->detach();

        foreach ($selectedMaterials as $materialId) {
            if ($materialId !== null) {
                $quantity = $quantities[$materialId] ?? 0;
                $event->materials()->attach($materialId, ['quantity' => $quantity]);

                $material = Materials::find($materialId);
                $material->quantity -= $quantity;
                $material->availability = ($material->quantity <= 0) ? 0 : 1;
                $material->save();
            }
        }

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

        $materials = $event->materials;

        $event->delete();

        foreach ($materials as $material) {
            $pivotData = $material->pivot;
            $originalQuantity = $pivotData->original['quantity'] ?? 0;
            $material->quantity += $originalQuantity;
            $material->availability = 1;
            $material->save();
        }

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

    public function sendReminder(Request $request, Events $events)
    {
        $eventId = $events->id;
        $event = Events::find($eventId);
        $user = $request->user();

        Notification::send($user, new Reminder($event));

    }
}
