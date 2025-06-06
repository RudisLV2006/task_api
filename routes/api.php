<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/register",[AuthController::class, "register"])->name("register");
Route::post("/login",[AuthController::class, "login"])->name("login");
Route::post("/logout",[AuthController::class, "logout"])->name("logout")->middleware('auth:sanctum');

Route::apiResource("task", TaskController::class);
