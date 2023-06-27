<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('provider.certifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Certification::create([
            'name' => $request->name,
            'description' => $request->description,
            'creator' => Auth::id(),
        ]);
        return redirect()->route('provider.certifications.index')->with('success', 'Certification created successfully.');
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

        return view('provider.certifications.edit', compact('certification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certification $certification)
    {
        $certification->name = $request->input('name');
        $certification->description = $request->input('description');

        $certification->save();

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
