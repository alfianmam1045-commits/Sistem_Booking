<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix("/auth")->group(function () {
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);
    Route::get("/refresh", [AuthController::class, "refresh"]);
});

Route::middleware('jwt.auth')->group(function () {
    Route::prefix("/auth")->group(function () {
        Route::get("me", [AuthController::class, "me"]);
        Route::delete("logout", [AuthController::class, "logout"]);
    });

});