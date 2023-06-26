<?php

namespace App\Http\Controllers\Steps;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Materials;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function stepOne(Request $request)
    {
        $event = $request->session()->get('event');

        return view('management.events.step-one', compact('event'));
    }

    public function storeStepOne(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'address' => ['required'],
            'max_capacity' => ['required', 'integer'],
            'type' => ['required'],
        ]);

        $event = new Events();
        $event->fill($validated);
        $request->session()->put('event', $event);

        return redirect()->route('management.events.step-two');
    }


    public function stepTwo(Request $request)
    {
        $event = $request->session()->get('event');

        $res_room_ids = Events::orderBy('start_time')->get()->filter(function ($value) use ($event) {
            return $value->start_time == $event->start_time;
        })->pluck('id_room');

        $rooms = Rooms::where('availability', 1)
            ->where('max_capacity', '>=', $event->max_capacity)
            ->whereNotIn('id', $res_room_ids)->get();

        return view('management.events.step-two', compact('event', 'rooms'));
    }

    public function storeStepTwo(Request $request)
    {
        $validated = $request->validate([
            'room_name' => ['required'],
            'price' => ['required', 'numeric'],
            'difficulty' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'image' => ['required', 'file', 'image'], // Add image validation rule
        ]);

        // Check if the uploaded file is an image
        if (!$request->file('image')->isValid()) {
            return redirect()->back()->with('error', 'Invalid image file.');
        }

        $event = $request->session()->get('event');
        $roomName = $validated['room_name'];

        $room = Rooms::where('name', $roomName)->first();

        $user_id = Auth::id();

        $image = $request->file('image')->storeAs('event', $request->file('image')->getClientOriginalName(), 'public');
        $event->image = $image;

        $event->id_room = $room->id;
        $event->user_creator = $user_id;
        $event->fill($validated);
        $request->session()->put('event', $event);

        return redirect()->route('management.events.step-three');
    }


    public function stepThree(Request $request)
    {
        $event = $request->session()->get('event');

        $materials = Materials::where('availability', 1)->where('quantity', '>', 0)->get();

        return view('management.events.step-three', compact('event', 'materials'));
    }


    public function storeStepThree(Request $request)
    {
        $validated = $request->validate([
            'material_name' => ['required'],
        ]);

        $event = $request->session()->get('event');
        $materialName = $validated['material_name'];

        $material = Materials::where('name', $materialName)->first();

        $event->id_material = $material->id;
        $event->fill($validated);
        $event->save();
        $request->session()->forget('event');

        return redirect()->route('management.events.index')->with('success', 'Event created successfully.');
    }

}
