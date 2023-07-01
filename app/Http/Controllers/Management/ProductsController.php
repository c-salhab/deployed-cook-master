<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $products = Products::where('creator', $user->id)->get();
        return view('management.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $image = $request->file('image')->storeAs('product', $request->file('image')->getClientOriginalName(), 'public');

        Products::create([
            'image' => $image,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'creator' => Auth::id(),
        ]);

        return redirect()->route('management.products.index')->with('success', 'Product created successfully.');
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
    public function edit(Products $product)
    {
        $user = Auth::user();

        if ($product->creator !== $user->id) {
            abort(403);
        }

        return view('management.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $image = $product->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $image = $request->file('image')->storeAs('product', $request->file('image')->getClientOriginalName(), 'public');
        }

        $product->image = $image;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');

        $product->save();

        return redirect()->route('management.products.index')->with('warning', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $imagePath = $product->image;

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $product->delete();

        return redirect()->route('management.products.index')->with('danger', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $search_text = $request->input('query');
        $products = Products::where('name', 'LIKE', '%' . $search_text . '%')->get();

        return view('management.products.index', compact('products'));
    }
}
