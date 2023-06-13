<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;

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

Route::middleware("auth:sanctum")->group(function(){
    Route::get("/user",[SystemController::class,'user']);
    Route::post("/bycredit",[SystemController::class,'AddCredit']);
    Route::post("/sendMail",[SystemController::class,'sendMail']);
});

Route::post("/login",[SystemController::class,'login']);
Route::post("/register",[SystemController::class,'register']);
