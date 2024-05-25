<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function create()
    {
        log::info("Masuk ke form");
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }
    public function store(ProductCreateRequest $request)
    {
        log::info("Masuk ke store");

        $validated = $request->validated();

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $validated['image'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
        ]);

        $product->categories()->attach($validated['categories']);

        return response()->json([
            "message" => "Product created successfully",
        ]);
    }

    public function findByID($id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $arr = $product->toArray();
        $arr['categories'] = $product->categories->pluck('name');

        return response()->json($arr);
    }

    //want to make api for update product by id

    public function test()
    {
        log::info("Hello World");
        return response()->json([
            'message' => 'Hello World',
        ]);
    }
}
