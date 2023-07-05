<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentStoreRequest;
use App\Models\Formation;
use App\Models\Student;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $students = User::where('creator', $user->id)->get();


        return view('provider.students.index', compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formations = Formation::where('validated',1)->get();
        return view('provider.students.create',compact('formations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        $validated = $request->validate([
            'formation_name' => ['nullable', 'array'],
            'formation_name.*' => ['nullable', 'exists:formations,id'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'creator' => Auth::id(),
            'password' => bcrypt(Auth::user()->getAuthPassword())
        ]);

        $formationIds = $validated['formation_name'] ?: null;

        if (empty($formationIds) || in_array('', $formationIds)) {
            $user->formations()->detach();
        } else {
            $user->formations()->sync($formationIds);
        }

        return redirect()->route('provider.students.index')->with('success', 'Student created successfully.');
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
    public function edit(User $student)
    {
        $user = Auth::user();

        if ($student->creator !== $user->id) {
            abort(403);
        }

        $formations = Formation::all();
        $selectedFormations = $student->formations->pluck('id')->toArray();

        return view('provider.students.edit', compact('student', 'formations', 'selectedFormations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $student)
    {
        $user = Auth::user();

        if ($student->creator !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'formation_name' => ['nullable', 'array'],
            'formation_name.*' => ['nullable', 'exists:formations,id'],
        ]);

        $student->update($request->only(['first_name', 'last_name', 'email', 'phone', 'address']));

        $formationIds = $validated['formation_name'];

        if (empty($formationIds) || in_array('', $formationIds)) {
            $student->formations()->detach();
        } else {
            $student->formations()->sync($formationIds);
        }

        return redirect()->route('provider.students.index')->with('warning', 'Student updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student)
    {
        $student->delete();

        return redirect()->route('provider.students.index')->with('danger', 'Student deleted successfully!');
    }


    public function search(Request $request)
    {
        $search_text = $request->input('query');
        $students = User::where('first_name', 'LIKE', '%' . $search_text . '%')->get();

        return view('provider.students.index', compact('students'));
    }

}
