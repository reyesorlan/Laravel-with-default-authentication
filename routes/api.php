<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NookalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "auth"], function () {
    Route::post("/register", [UserController::class, "register"]);
    Route::post("/login", [UserController::class, "login"]);
    Route::post("/forgot-password", [UserController::class, "forgot"]);
    Route::post('/reset', [UserController::class, "reset"]);

    Route::middleware("auth:sanctum")->group(function () {
        Route::post("/user", [UserController::class, "createUser"]);
        Route::put("/user/{id}", [UserController::class, "modifyUser"]);
        Route::delete("/user/{id}", [UserController::class, "deleteUser"]);
        Route::post("/logout", [UserController::class, "photout"]);
        Route::get("/user", [UserController::class, "user"]);
        Route::get("/users", [UserController::class, "users"]);
        Route::get("/user/permissions", [UserController::class, "getPermissions"]);
    });
});

Route::group(["prefix" => "nookal", "middleware" => ["auth:sanctum"]], function() {
    Route::get("/patients", [NookalController::class, "getPatients"]);
});

Route::get("/", function(Request $request){
    echo "test";
});