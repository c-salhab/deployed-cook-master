<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FormationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::all();

        foreach ($formations as $formation) {
            $creator = User::find($formation->creator);

            if ($creator) {
                $formation->creator_name = $creator->first_name . ' ' . $creator->last_name;
            }
        }

        return view('management.formations.index',compact('formations'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $formation = Formation::with('creator')->find($id);
        return view('management.formations.index',compact('formation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        return view('management.formations.edit', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formation $formation)
    {
        $image = $formation->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($formation->image);
            $image = $request->file('image')->storeAs('course', $request->file('image')->getClientOriginalName(), 'public');
        }

        $formation->image = $image;
        $formation->name = $request->input('name');
        $formation->description = $request->input('description');

        $validated = $request->input('status') === 'validated' ? 1 : 0;
        $formation->validated = $validated;

        $formation->save();

        return redirect()->route('management.formations.index')->with('warning', 'Formation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        $formation->delete();

        return redirect()->route('management.formations.index')->with('danger', 'Formation deleted successfully.');
    }

    public function search(Request $request)
    {
        $search_text = $request->input('query');
        $formations = Formation::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('management.formations.index', compact('formations'));
    }
}
