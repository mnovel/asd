<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::prefix('auth')->name('auth')->group(function () {
    Route::post('signin', [AuthController::class, 'authSignIn'])->name('.signIn');
    // Route::post('signup', [VoterController::class, 'store'])->name('.signUp');
    Route::get('signout', [AuthController::class, 'authLogout'])->name('.logout');
});


Route::prefix('create')->name('create')->group(function () {
    Route::post('class', [ClassesController::class, 'store'])->name('.class');
    Route::post('user', [UserController::class, 'store'])->name('.user');
});

Route::prefix('edit')->name('edit')->group(function () {
    Route::put('class/{classes}', [ClassesController::class, 'update'])->name('.class');
    Route::put('user/{user}', [UserController::class, 'update'])->name('.user');
});

Route::prefix('delete')->name('delete')->group(function () {
    Route::delete('class/{classes}', [ClassesController::class, 'destroy'])->name('.class');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('.user');
});


Route::middleware(['auth:web'])->group(function () {

    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware(['permission:Dashboard']);

    Route::middleware(['permission:Participant'])->prefix('participant')->name('participant')->group(function () {
        Route::get('class', [ClassesController::class, 'index'])->name('.class');
        Route::get('class/edit/{classes}', [ClassesController::class, 'edit'])->name('.class.edit');

        Route::get('user', [UserController::class, 'index'])->name('.user');
        Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('.user.edit');
    });
});
