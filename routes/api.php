<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
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

    Route::get("/users", [UserController::class, "getAllData"]);
    Route::get("/users/{id}", [UserController::class, "getSingleData"]);
    Route::post("/users", [UserController::class, "createData"]);
    Route::patch("/users/{id}", [UserController::class, "updateData"]);
    Route::delete("/users/{id}", [UserController::class, "deleteData"]);

    Route::get("/services", [ServiceController::class, "getAllData"]);
    Route::get("/services/{id}", [ServiceController::class, "getSingleData"]);
    Route::post("/services", [ServiceController::class, "createData"]);
    Route::patch("/services/{id}", [ServiceController::class, "updateData"]);
    Route::delete("/services/{id}", [ServiceController::class, "deleteData"]);

    Route::get("/bookings", [BookingController::class, "getAllData"]);
    Route::get("/bookings/{id}", [BookingController::class, "getSingleData"]);
    Route::post("/bookings", [BookingController::class, "createData"]);
    Route::patch("/bookings/{id}", [BookingController::class, "updateData"]);
    Route::delete("/bookings/{id}", [BookingController::class, "deleteData"]);

});