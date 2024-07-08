<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\Autorize;


// Route::get('/', function () {
//     return view('welcome');
// })->name("welcome");
Route::get('/', function () {
    return view('auth.login');
})->name("welcome");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/roles', [RoleController::class, 'index'])->name('roles.list');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');

//->middleware(Autorize::class)
Route::get('/ressources', [RessourceController::class, 'index'])->name('ressources.index');
Route::get('/ressources/create', [RessourceController::class, 'create'])->name('ressources.create');
Route::get('/ressources/createmany', [RessourceController::class, 'list'])->name('ressources.list');
Route::post('/ressources/store', [RessourceController::class, 'store'])->name('ressources.store');

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth')->middleware(Autorize::class);
Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware('auth')->middleware(Autorize::class);
Route::get('/users/find/{id}', [UserController::class, 'find'])->name('users.find')->middleware('auth')->middleware(Autorize::class);
Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete')->middleware('auth')->middleware(Autorize::class);
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update')->middleware('auth')->middleware(Autorize::class);

Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index')->middleware('auth')->middleware(Autorize::class);
Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create')->middleware('auth')->middleware(Autorize::class);
Route::get('/contracts/edit/{id}', [ContractController::class, 'edit'])->name('contracts.edit')->middleware('auth')->middleware(Autorize::class);
Route::put('/contracts/update/{id}', [ContractController::class, 'update'])->name('contracts.update')->middleware('auth')->middleware(Autorize::class);
Route::delete('/contracts/delete/{contract}', [ContractController::class, 'destroy'])->name('contracts.delete')->middleware('auth')->middleware(Autorize::class);
Route::get('/contracts/download/{id}', [ContractController::class, 'download'])->name('contracts.download')->middleware('auth')->middleware(Autorize::class);
Route::post('/contracts/store', [ContractController::class, 'store'])->name('contracts.store')->middleware('auth')->middleware(Autorize::class);
// Route::get('/contracts/pdf', [ContractController::class, 'showPdf'])->name('contracts.pdf');
Route::get('/contracts/pdf', function () {
    return view('contracts.pdf');
})->name('pdf');

Route::get('/contracts/{contract_id}/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/contracts/{contract_id}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/contracts/{contract_id}/tasks/store', [TaskController::class, 'store'])->name('tasks.store');

Route::get('/contracts/{contract_id}/payments/', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/contracts/{contract_id}/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/contracts/{contract_id}/payments/store', [PaymentController::class, 'store'])->name('payments.store');

require __DIR__.'/auth.php';
