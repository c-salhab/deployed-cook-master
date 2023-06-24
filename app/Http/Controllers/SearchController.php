<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms; // Remplacez "YourModel" par le nom de votre modèle

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $capacity = $request->input('capacity');

        // Effectuez une requête dans votre base de données pour obtenir les données correspondantes
        $results = Rooms::where('max_capacity', $capacity)->get(); // Remplacez "YourModel" par le nom de votre modèle

        return response()->json($results);
    }
}
