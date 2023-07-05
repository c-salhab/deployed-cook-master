<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentalStoreRequest;
use App\Models\Events;
use App\Models\Rentals;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class RentalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $rentals = Rentals::where('user_id', $user->id)->get();
        return view('management.rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.rentals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RentalStoreRequest $request)
    {
        //
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
    public function edit(Rentals $rental)
    {
        $user = Auth::user();

        if ($rental->user_id !== $user->id) {
            abort(403); // Renvoie une réponse "Forbidden"
        }

        return view('management.rentals.edit', compact('rental'));
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Rentals $rental)
    {
        $image = $rental->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($rental->image);
            $image = $request->file('image')->storeAs('rental', $request->file('image')->getClientOriginalName(), 'public');
        }

        $rental->name = $request->input('name');
        $rental->price = $request->input('price');
        $rental->quantity = $request->input('quantity');
        $rental->state = $request->input('state');
        $rental->status = $request->input('status');
        $rental->image = $image;
        $rental->description = $request->input('description');
        $rental->start_time = $request->input('start_time');

        if ($request->filled('end_time')) {
            $rental->end_time = $request->input('end_time');
        }

        $rental->save();

        return redirect()->route('management.rentals.index')->with('warning', 'Rental updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rentals $rental)
    {
        $imagePath = $rental->image;

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $rental->delete();

        return redirect()->route('management.rentals.index')->with('danger', 'Rental deleted successfully.');
    }


    public function search(Request $request)
    {
        $searchText = $request->input('query');

        $user = User::where('first_name', 'LIKE', '%' . $searchText . '%')->first();

        if (!$user) {
            $rentals = collect();
        } else {
            $rentals = Rentals::where('user_id', $user->id)->get();
        }

        return view('management.rentals.index', compact('rentals'));
    }

}
