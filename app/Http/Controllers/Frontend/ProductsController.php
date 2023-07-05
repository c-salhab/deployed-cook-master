<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(){
        $products = Products::all();
        return view('shop.index', compact('products'));
    }

    public function addToCart($name)
    {
        $product = DB::table('products')->where('name', $name)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $cart = session()->get('cart', []);
        $quantity = $product->quantity;

        if (isset($cart[$product->name])) {
            $cart[$product->name]['quantity']++;
            if($cart[$product->name]['quantity'] > $quantity){
                return redirect()->back()->with('error', 'Quantity exceeded !');
            }
        } else {
            $cart[$product->name] = [
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}
