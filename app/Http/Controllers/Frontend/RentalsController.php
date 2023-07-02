<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Rentals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RentalsController extends Controller
{
    public function index(){
        $rentals = Rentals::all();
        return view('rentals.index', compact('rentals'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function addToCart($name)
    {
        $rental = DB::table('rentals')->where('name', $name)->first();

        if (!$rental) {
            return redirect()->back()->with('error', 'Rental not found!');
        }

        $cart = session()->get('cart', []);
        $quantity = $rental->quantity;

        if (isset($cart[$rental->name])) {
            $cart[$rental->name]['quantity']++;
            if($cart[$rental->name]['quantity'] > $quantity){
                return redirect()->back()->with('error', 'Quantity exceeded !');
            }
        } else {
            $cart[$rental->name] = [
                'name' => $rental->name,
                'image' => $rental->image,
                'price' => $rental->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }




    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('warning', 'Cart successfully updated!');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('error', 'Successfully removed!');
        }
    }

}
