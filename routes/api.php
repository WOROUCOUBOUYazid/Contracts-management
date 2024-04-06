<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\api\LoginController;

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
//Route::post('/personCreate', [PersonController::class, 'store']);

Route::prefix('/user')->group(function () {
    //Route::post('/login', 'App\Http\Controllers\api\LoginController@login');
    Route::post('/login', [LoginController::class, 'login']);
});
