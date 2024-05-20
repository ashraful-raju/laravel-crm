<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->with('user')->get();

        return view('products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', ['product' => new Product()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'unit_price' => ['required', 'string'],
            'pre_quantity' => ['nullable', 'string'],
            'available' => ['nullable', 'string'],
            'image' => ['nullable', 'image']
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products');
        }

        /**
         * @var \App\Models\User $user
         */
        $user = $request->user();
        $user->products()->create($data);

        return redirect()
            ->route('products.index')
            ->with('alert', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.create', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'unit_price' => ['required', 'string'],
            'pre_quantity' => ['nullable', 'string'],
            'available' => ['nullable', 'string'],
            'image' => ['nullable', 'image']
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products');

            if ($product->image && Storage::fileExists($product->image)) {
                Storage::delete($product->image);
            }
        }

        $product->update($data);

        return back()
            ->with('alert', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        if ($product->image && Storage::fileExists($product->image)) {
            Storage::delete($product->image);
        }

        return back()
            ->with('alert', 'Product deleted successfully!');
    }
}
