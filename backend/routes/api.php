<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

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

Route::middleware("security")->group(function () {
    Route::post("chats", [ChatController::class, "newChat"]);
    Route::patch("chats/{chat}", [ChatController::class, "update"]);
    Route::post("chats/new-user", [ChatController::class, "newUser"]);
    Route::delete("chats/remove-user", [ChatController::class, "removeUser"]);

    Route::middleware("auth:api")->group(function () {
        Route::get("register", [ChatController::class, "register"]);
        Route::get("chats", [ChatController::class, "index"]);
        Route::get("chats/{chat}", [ChatController::class, "chatInfo"]);

        Route::post("messages", [ChatController::class, "store"]);
//        Route::post("/broadcasting/auth", function (Request $request) {
//            return Broadcast::auth($request);
//        });
    });
});
