<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(CategoryCreateRequest $request)
    {
        $validate = $request->validated();

        $category = Category::create([
            'name' => $validate['name'],
        ]);

        return response()->json($category, 201);
    }

    public function index()
    {
        $category = Category::select('id', 'name')->get();
        return response()->json($category);
    }

    public function removeProd($id)
    {
        $category = Category::find($id);
        $category->products()->detach();
    }

    public function delete($id)
    {
        $category = Category::findorFail($id);
        $this->removeProd($id);
        $category->delete();
        return response()->json([
            "message" => "Category deleted successfully",
        ]);
    }
}
