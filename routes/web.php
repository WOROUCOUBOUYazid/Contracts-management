<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
})->name("tienstiens");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/roles', [RoleController::class, 'index'])->name('roles.list');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');

Route::get('/ressources', [RessourceController::class, 'index'])->name('ressources.index');
Route::get('/ressources/create', [RessourceController::class, 'create'])->name('ressources.create');
Route::get('/ressources/createmany', [RessourceController::class, 'list'])->name('ressources.list');
Route::post('/ressources/store', [RessourceController::class, 'store'])->name('ressources.store');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
Route::get('/contracts/edit/{id}', [ContractController::class, 'edit'])->name('contracts.edit');
Route::put('/contracts/update/{id}', [ContractController::class, 'update'])->name('contracts.update');
Route::delete('/contracts/delete/{contract}', [ContractController::class, 'destroy'])->name('contracts.delete');
Route::get('/contracts/download/{id}', [ContractController::class, 'download'])->name('contracts.download');
Route::post('/contracts/store', [ContractController::class, 'store'])->name('contracts.store');
Route::get('/contracts/pdf', [ContractController::class, 'showPdf'])->name('contracts.pdf');

require __DIR__.'/auth.php';
