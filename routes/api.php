<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ItemController;
use App\Http\Middleware\ApiAuthenticated;
use App\Http\Middleware\SetBearerToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("v1")->group(function () {

    Route::apiResource("item", ItemController::class)->middleware(['authenticated']);


    Route::controller(AuthController::class)->group(function () {
        Route::post("/register", "register")->name("api.auth.register");
        Route::post("/login", "login")->name("api.auth.login");
    });
});
