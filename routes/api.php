<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get("/product/{id}",[ProductController::class, 'findByID']);
Route::post("/product/create",[ProductController::class, 'store']);


Route::get("/test", [ProductController::class, 'test']);
