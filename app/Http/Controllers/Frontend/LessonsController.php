<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Lessons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonsController extends Controller
{
    public function index(){
        $lessons = Lessons::all();
        return view('lessons.index', compact('lessons'));
    }


    public function addToCart($name)
    {
        $lesson = DB::table('lessons')->where('name', $name)->first();

        if (!$lesson) {
            return redirect()->back()->with('error', 'Lesson not found!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$lesson->name])) {
            return redirect()->back()->with('error', 'Lesson already in cart!');
        } else {
            $cart[$lesson->name] = [
                'name' => $name,
                'image' => $lesson->image,
                'price' => $lesson->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Lesson added to cart successfully!');
    }

}
