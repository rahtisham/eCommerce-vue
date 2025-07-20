<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Numeric;
use Inertia\Inertia;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return Inertia::render('products/Index', ['products' => $products]);
    }

    public function create()
    {
        return Inertia::render('products/Create', []);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:500',
        ]);

        Product::create($data);

        return redirect()->route('products.create')->with('message', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        return Inertia::render('products/edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:500',
        ]);

        $product->update($data);

        return redirect()->back()->with('success', 'Product has been Updated successfully!');
    }

    function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }
}
