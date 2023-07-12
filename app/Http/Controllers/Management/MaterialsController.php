<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialStoreRequest;
use App\Models\Materials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $materials = Materials::where('user_id', $user->id)->get();
        return view('management.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialStoreRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $image = $request->file('image')->storeAs('material', $request->file('image')->getClientOriginalName(), 'public');

        Materials::create([
            'image' => $image,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'state' => $request->state,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('management.materials.index')->with('success', 'Material created successfully.');
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
    public function edit(Materials $material)
    {
        $user = Auth::user();

        if ($material->user_id !== $user->id) {
            abort(403); // Renvoie une réponse "Forbidden"
        }

        return view('management.materials.edit', compact('material'));
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Materials $material)
    {
        $image = $material->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($material->image);
            $image = $request->file('image')->storeAs('material', $request->file('image')->getClientOriginalName(), 'public');
        }

        $material->image = $image;
        $material->name = $request->input('name');
        $material->description = $request->input('description');
        $material->quantity = $request->input('quantity');
        $material->state = $request->input('state');

        $availability = $request->input('status') === 'available' ? 1 : 0;
        $material->availability = $availability;

        $material->save();

        return redirect()->route('management.materials.index')->with('warning', 'Material updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materials $material)
    {
        $imagePath = $material->image;

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $material->delete();

        return redirect()->route('management.materials.index')->with('danger', 'Material deleted successfully.');
    }

    public function search(Request $request)
    {
        $search_text = $request->input('query');
        $materials = Materials::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('management.materials.index', compact('materials'));
    }
}
