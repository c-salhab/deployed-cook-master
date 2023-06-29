<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CertificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $certifications = Certification::where('creator', $user->id)->get();
        return view('provider.certifications.index', compact('certifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formations = Formation::whereNull('certification_id')->orWhere('certification_id', '')->get();
        return view('provider.certifications.create',compact('formations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'formation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $formationName = $request->formation;

        $certification = Certification::create([
            'name' => $request->name,
            'description' => $request->description,
            'creator' => Auth::id(),
        ]);

        $formation = Formation::where('name', $formationName)->first();
        if ($formation) {
            $formation->certification_id = $certification->id;
            $formation->save();
        }

        return redirect()->route('provider.certifications.index')->with('success', 'Certification created successfully');
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
    public function edit(Certification $certification)
    {
        $user = Auth::user();

        if ($certification->creator !== $user->id) {
            abort(403);
        }

        $formations = Formation::whereNull('certification_id')->orWhere('certification_id', '')->get();

        return view('provider.certifications.edit', compact('certification', 'formations'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certification $certification)
    {

        $validator = Validator::make($request->all(), [
            'formation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $certification->name = $request->input('name');
        $certification->description = $request->input('description');
        $certification->save();

        $formationName = $request->formation;
        $formation = Formation::where('name', $formationName)->first();

        // Reset the previous formation's certification ID
        if ($formation) {
            $previousFormation = Formation::where('certification_id', $certification->id)->first();
            if ($previousFormation) {
                $previousFormation->certification_id = null;
                $previousFormation->save();
            }

            $formation->certification_id = $certification->id;
            $formation->save();
        }

        return redirect()->route('provider.certifications.index')->with('warning', 'Certification updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certification $certification)
    {
        $certification->delete();

        return redirect()->route('provider.certifications.index')->with('danger', 'Certification deleted successfully!');
    }

    public function search(Request $request)
    {
        $search_text = $request->input('query');
        $certifications = Certification::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('provider.certifications.index', compact('certifications'));
    }
}
