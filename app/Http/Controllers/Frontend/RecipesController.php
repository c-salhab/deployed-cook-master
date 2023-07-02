<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Recipes;
use Illuminate\Http\Request;

class RecipesController
{
    public function index(){
        $recipes = Recipes::all();
        return view('recipes.index', compact('recipes'));
    }

    public function search(Request $request)
    {
        $search_text = $request->input('query');
        $recipes = Recipes::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('recipes.index', compact('recipes'));
    }
}