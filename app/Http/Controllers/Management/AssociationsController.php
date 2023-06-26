<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssociationsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $events = Events::with('material')->where('user_creator', $user->id)->get();
        return view('management.associations.index', compact('events'));
    }
}
