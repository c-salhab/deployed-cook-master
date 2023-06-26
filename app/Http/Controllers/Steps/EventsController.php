<?php

namespace App\Http\Controllers\Steps;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Materials;
use App\Models\Rooms;
use App\Notifications\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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
            'room_name' => ['nullable', 'exists:rooms,name'], // Validate that the room name exists in the rooms table
            'price' => ['required', 'numeric'],
            'difficulty' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        $validated = array_merge($validated, ['room_name' => $request->input('room_name', '')]);

        $event = $request->session()->get('event');
        $roomName = $validated['room_name'];

        if (!empty($roomName)) {
            $room = Rooms::where('name', $roomName)->first();
            $event->id_room = $room->id;
        } else {
            $event->id_room = null; // Set room ID as null if no room name is provided
        }

        $user_id = Auth::id();

        $image = $request->file('image')->storeAs('event', $request->file('image')->getClientOriginalName(), 'public');
        $event->image = $image;

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
            'material_name' => ['nullable', 'array'],
            'material_name.*' => ['nullable', 'exists:materials,id'],
            'quantity' => ['nullable', 'array'],
            'quantity.*' => ['nullable', 'integer', 'min:0'],
        ]);

        $event = $request->session()->get('event');

        $selectedMaterials = $validated['material_name'] ?? [];
        $quantities = $validated['quantity'] ?? [];

        $event->fill($validated);
        $event->save();

        $materials = [];
        foreach ($selectedMaterials as $materialId) {
            if ($materialId !== null) {
                $quantity = $quantities[$materialId] ?? 0;
                $materials[$materialId] = ['quantity' => $quantity];
            }
        }

        $event->materials()->sync($materials);

        foreach ($materials as $materialId => $materialData) {
            $quantity = $materialData['quantity'];
            $material = Materials::find($materialId);
            $material->quantity -= $quantity;
            $material->availability = ($material->quantity <= 0) ? 0 : 1;
            $material->save();
        }

        $request->session()->forget('event');
        return redirect()->route('management.events.index')->with('success', 'Event created successfully.');
    }

}
