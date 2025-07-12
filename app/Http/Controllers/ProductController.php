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
        return Inertia::render('products/Index', []);
    }

    public function create()
    {
        return Inertia::render('products/Create', []);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:500',
        ]);

        Product::create($data);

        return redirect()->route('products')->with('message', 'Product created successfully!');
    }
}
