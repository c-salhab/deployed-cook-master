<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentalStoreRequest;
use App\Models\Materials;
use App\Models\Rentals;
use App\Models\RentalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalsController extends Controller
{
    public function index()
    {
        $materials = Materials::all();
        return view('rentals.index', compact('materials'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function addToCart($name, RentalStoreRequest $request)
    {
        $material = DB::table('materials')->where('name', $name)->first();

        if (!$material) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $cart = session()->get('cart', []);
        $quantity = $material->quantity;

        if (isset($cart[$material->name])) {
            $cart[$material->name]['quantity']++;
            if ($cart[$material->name]['quantity'] > $quantity) {
                return redirect()->back()->with('error', 'Quantity exceeded!');
            }
        } else {
            $cart[$material->name] = [
                'name' => $material->name,
                'image' => $material->image,
                'price' => $material->price,
                'quantity' => 1,
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('warning', 'Cart successfully updated!');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('error', 'Successfully removed!');
        }
    }

    public function store(RentalStoreRequest $request)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:materials,id',
        ]);

        $userId = auth()->id();

        $rental = new Rentals();
        $rental->user_id = $userId;
        $rental->start_time = $request->input('start_time');
        $rental->end_time = $request->input('end_time');
        $rental->save();

        $rental->materials()->attach($request->input('product_ids'));

        return redirect()->back()->with('success', 'Rental created successfully');
    }
}
