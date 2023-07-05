<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonStoreRequest;
use App\Models\Lessons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $lessons = Lessons::where('creator', $user->id)->get();
        return view('management.lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonStoreRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'score' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $image = $request->file('image')->storeAs('lesson', $request->file('image')->getClientOriginalName(), 'public');

        Lessons::create([
            'image' => $image,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'creation_date' => $request->creation_date,
            'score' => $request->score,
            'creator' => Auth::id(),
        ]);

        return redirect()->route('management.lessons.index')->with('success', 'Lesson created successfully.');
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
    public function edit(Lessons $lesson)
    {
        $user = Auth::user();

        if ($lesson->creator !== $user->id) {
            abort(403);
        }

        return view('management.lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lessons $lesson)
    {
        $image = $lesson->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($lesson->image);
            $image = $request->file('image')->storeAs('lesson', $request->file('image')->getClientOriginalName(), 'public');
        }

        $lesson->image = $image;
        $lesson->name = $request->input('name');
        $lesson->description = $request->input('description');
        $lesson->price = $request->input('price');
        $lesson->duration = $request->input('duration');
        $lesson->score = $request->input('score');
        $lesson->creation_date = $request->input('creation_date');

        $lesson->save();

        return redirect()->route('management.lessons.index')->with('warning', 'Lesson updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lessons $lesson)
    {
        $imagePath = $lesson->image;

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $lesson->delete();

        return redirect()->route('management.lessons.index')->with('danger', 'Lesson deleted successfully.');
    }

    public function search(Request $request)
    {
        $search_text = $request->input('query');
        $lessons = Lessons::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('management.lessons.index', compact('lessons'));
    }
}
