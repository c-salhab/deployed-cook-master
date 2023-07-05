<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class FormationsController extends Controller
{
    public function index(){
        $formations = Formation::where('validated', 1)->get();
        return view('formations.index', compact('formations'));
    }

    public function addToCart($name)
    {
        $formation = DB::table('formations')->where('name', $name)->first();

        if (!$formation) {
            return redirect()->back()->with('error', 'Formation not found!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$formation->name])) {
            return redirect()->back()->with('error', 'Formation already in cart!');
        } else {
            $cart[$formation->name] = [
                'name' => $formation->name,
                'image' => $formation->image,
                'price' => $formation->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Formation added to cart successfully!');
    }

}
