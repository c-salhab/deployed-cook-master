<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormationStoreRequest;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $formations = Formation::where('creator', $user->id)->get();
        return view('provider.courses.index', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('provider.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormationStoreRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'score' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $image = $request->file('image')->storeAs('course', $request->file('image')->getClientOriginalName(), 'public');

        Formation::create([
            'image' => $image,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'score' => $request->score,
            'duration' => $request->duration,
            'creator' => Auth::id(),
        ]);

        return redirect()->route('provider.courses.index')->with('success', 'Formation created successfully.');
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
    public function edit(Formation $course)
    {
        $user = Auth::user();

        if ($course->creator !== $user->id) {
            abort(403);
        }

        return view('provider.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formation $course)
    {
        $image = $course->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($course->image);
            $image = $request->file('image')->storeAs('course', $request->file('image')->getClientOriginalName(), 'public');
        }

        $course->image = $image;
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->price = $request->input('price');
        $course->duration = $request->input('duration');
        $course->score = $request->input('score');

        $course->save();

        return redirect()->route('provider.courses.index')->with('warning', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $course)
    {
        $imagePath = $course->image;

        if (!empty($imagePath) && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $course->delete();

        return redirect()->route('provider.courses.index')->with('danger', 'Course deleted successfully!');
    }

}
