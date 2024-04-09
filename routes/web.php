<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContractController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/user', [AdminController::class, 'dashboard']);

//Auth page
Route::view('/login', 'login');

//Admin pages
Route::view('/adminDashboard', 'admin/adminDashboard');
Route::get('/users', [UserController::class, 'index']);
Route::post('/users/store', [UserController::class, 'store']);
Route::get('/users/find/{id}', [UserController::class, 'find']);
Route::post('/users/update/{id}', [UserController::class, 'update']);
Route::post('/users/destroy/{id}', [UserController::class, 'destroy']);
// Route::resource('/users', 'UserController');

//Manager pages
Route::view('/managerDashboard', 'manager/managerDashboard');
Route::get('/contracts', ContractController::class.'@index');
Route::post('/contracts/store', [ContractController::class.'@store']);
Route::view('/payments', 'manager/payments');
Route::view('/tasks', 'manager/tasks');

//ServiceProvider page

//Template
Route::view('/dashboard', 'dashboard');

