<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function create()
    {
        log::info("Masuk ke form");
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function index()
    {
        $products = Product::with(['categories:id,name'])->get();

        return response()->json($products);
    }

    public function findByID($id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $arr = $product->toArray();
        $arr['categories'] = $product->categories->pluck('name');

        return response()->json($arr);
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

        return response()->json($product, 201);
    }

    public function update(ProductUpdateRequest $request,$id)
    {
        log::info("MASUK KE UPDATE");
        $validate = $request->validated();
        $product = Product::findorFail($id);

        if (isset($validate['name'])) {
            $product->name = $validate['name'];
        }
        if (isset($validate['description'])) {
            $product->description = $validate['description'];
        }
        if (isset($validate['im age'])) {
            $product->image = $validate['image'];
        }
        if (isset($validate['price'])) {
            $product->price = $validate['price'];
        }
        if (isset($validate['stock'])) {
            $product->stock = $validate['stock'];
        }
        if (isset($validate['categories'])) {
            $product->categories()->sync($validate['categories']);
        }

        $product->update([
            'name' => $product->name,
            'description' => $product->description,
            'image' => $product->image,
            'price' => $product->price,
            'stock' => $product->stock,
        ]);

        $product->categories()->sync($validate['categories']);

        return response()->json([
            "message" => "Product updated successfully",
        ]);
    }

    public function removeCat($id)
    {
        $product = Product::findorFail($id);
        $product->categories()->detach();
    }

    public function delete($id)
    {
        $product = Product::findorFail($id);
        $this->removeCat($id);
        $product->delete();
        return response()->json([
            "message" => "Product deleted successfully",
        ]);
    }


    public function test()
    {
        log::info("Hello World");
        return response()->json([
            'message' => 'Hello World',
        ]);
    }
}
