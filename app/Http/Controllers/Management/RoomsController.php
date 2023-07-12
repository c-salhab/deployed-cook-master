<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreRequest;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $rooms = Rooms::where('user_id', $user->id)->get();
        return view('management.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomStoreRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'max_capacity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $image = $request->file('image')->storeAs('room', $request->file('image')->getClientOriginalName(), 'public');

        Rooms::create([
            'image' => $image,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'max_capacity' => $request->max_capacity,
            'address' => $request->address,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('management.rooms.index')->with('success', 'Room created successfully.');
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
    public function edit(Rooms $room)
    {
        $user = Auth::user();

        if ($room->user_id !== $user->id) {
            abort(403); // Renvoie une réponse "Forbidden"
        }

        return view('management.rooms.edit', compact('room'));
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Rooms $room)
    {
        $image = $room->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($room->image);
            $image = $request->file('image')->storeAs('room', $request->file('image')->getClientOriginalName(), 'public');
        }

        $room->image = $image;
        $room->name = $request->input('name');
        $room->description = $request->input('description');
        $room->price = $request->input('price');
        $room->max_capacity = $request->input('max_capacity');
        $room->address = $request->input('address');

        $availability = $request->input('status') === 'available' ? 1 : 0;
        $room->availability = $availability;

        $room->save();

        return redirect()->route('management.rooms.index')->with('warning', 'Room updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rooms $room)
    {
        $imagePath = $room->image;

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $room->delete();

        return redirect()->route('management.rooms.index')->with('danger', 'Room deleted successfully.');
    }

    public function search(Request $request)
    {
        $search_text = $request->input('query');
        $rooms = Rooms::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('management.rooms.index', compact('rooms'));
    }

}
