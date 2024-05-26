<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
//group untuk product
Route::prefix('product')->group(function(){
    Route::get("/",[ProductController::class, 'index']);
    Route::get("/{id}",[ProductController::class, 'findByID']);
    Route::post("/create",[ProductController::class, 'store']);
    Route::put("/update/{id}",[ProductController::class, 'update']);
    Route::delete("/delete/{id}",[ProductController::class, 'delete']);
});


Route::get("/test", [ProductController::class, 'test']);
