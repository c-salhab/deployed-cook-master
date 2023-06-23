<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Models\Events;
use Illuminate\Http\Request;
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
        $events = Events::where('user_id', $user->id)->get();
        return view('management.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(EventStoreRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'max_capacity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $image = $request->file('image')->storeAs('event', $request->file('image')->getClientOriginalName(), 'public');
        $user_id = Auth::id();

        Events::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image,
            'description' => $request->description,
            'user_id' => $user_id,
            'address' => $request->address,
            'max_capacity' => $request->max_capacity,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('management.events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $event)
    {
        $user = Auth::user();

        if ($event->user_id !== $user->id) {
            abort(403); // Renvoie une réponse "Forbidden"
        }
        return view('management.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Events $event){

    $image = $event->image;

    if ($request->hasFile('image')) {
        Storage::disk('public')->delete($event->image);
        $image = $request->file('image')->storeAs('event', $request->file('image')->getClientOriginalName(), 'public');
    }

    $data = [
        'name' => $request->input('name'),
        'address' => $request->input('address'),
        'max_capacity' => $request->input('max_capacity'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'start_time' => $request->input('start_time'),
        'image' => $image,
    ];

    if ($request->filled('end_time')) {
        $data['end_time'] = $request->input('end_time');
    }

    $event->update($data);

    return redirect()->route('management.events.index')->with('warning', 'Rental updated successfully.');
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

        return redirect()->route('management.events.index')->with('danger', 'Rental deleted successfully.');
    }

}
