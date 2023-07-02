<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeStoreRequest;
use App\Models\Recipes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $recipes = Recipes::where('creator', $user->id)->get();
        return view('management.recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeStoreRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $image = $request->file('image')->storeAs('recipe', $request->file('image')->getClientOriginalName(), 'public');

        Recipes::create([
            'image' => $image,
            'name' => $request->name,
            'steps' => $request->steps,
            'duration' => $request->duration,
            'difficulty' => $request->difficulty,
            'quantity' => $request->quantity,
            'ingredients' => $request->ingredients,
            'creator' => Auth::id(),
        ]);

        return redirect()->route('management.recipes.index')->with('success', 'Recipe created successfully.');
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
    public function edit(Recipes $recipe)
    {
        $user = Auth::user();

        if ($recipe->creator !== $user->id) {
            abort(403);
        }

        return view('management.recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipes $recipe)
    {
        $image = $recipe->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($recipe->image);
            $image = $request->file('image')->storeAs('recipe', $request->file('image')->getClientOriginalName(), 'public');
        }

        $recipe->image = $image;
        $recipe->name = $request->input('name');
        $recipe->steps = $request->input('steps');
        $recipe->quantity = $request->input('quantity');
        $recipe->duration = $request->input('duration');
        $recipe->difficulty =  $request->input('difficulty');
        $recipe->ingredients =  $request->input('ingredients');
        $recipe->save();

        return redirect()->route('management.recipes.index')->with('warning', 'Recipe updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipes $recipe)
    {
        $imagePath = $recipe->image;

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $recipe->delete();

        return redirect()->route('management.recipes.index')->with('danger', 'Recipe deleted successfully.');
    }

    public function search(Request $request)
    {
        $search_text = $request->input('query');
        $recipes = Recipes::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('management.recipes.index', compact('recipes'));
    }
}
