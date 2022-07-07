<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        return response()->json(Product::all());
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);
        return $product;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:products|max:255',
            'value' => 'required|integer',
            'stock' => 'required|integer',
            ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validatedData = $request->validate([
            'name' => 'string|unique:products|max:255',
            'value' => 'integer',
            'stock' => 'integer',
            ]);

        $product->update($validatedData);
        return response()->json($product, 200);
    }

    public function delete(Request $request, Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();
        return response()->json(null, 204);
    }
}
