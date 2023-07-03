<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Validation des champs
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Vérification de l'authentification
        if (auth()->attempt(['username' => $username, 'password' => $password])) {
            // Authentification réussie
            return response()->json('Login Success');
        } else {
            // Nom d'utilisateur ou mot de passe incorrect
            return response()->json('Username or Password wrong', 401);
        }
    }
}
