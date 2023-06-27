<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentStoreRequest;
use App\Models\Formation;
use App\Models\Student;
use App\Models\User;
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
        return view('provider.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {

        $password = Auth::user()->getAuthPassword();
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'creator' => Auth::id(),
            'password' => $password
        ]);

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

        return view('provider.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $student)
    {

        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->email = $request->input('email');
        $student->phone = $request->input('address');
        $student->phone = $request->input('phone');

        $student->save();

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
