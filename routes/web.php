<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:superadmin'])->group(function () {

    Route::resource('menus', MenuController::class);
    Route::get('menus-data', [MenuController::class, 'data'])->name('menus.data');

    Route::resource('roles', RoleController::class);
    Route::get('roles-data',[RoleController::class,'data'])->name('roles.data');

    Route::resource('permissions', PermissionController::class);
    Route::get('permissions-data', [PermissionController::class,'data'])->name('permissions.data');

    Route::resource('users', UserController::class);
    Route::get('users-data', [UserController::class,'data'])->name('users.data');
});

require __DIR__.'/auth.php';
