<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrecenceController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\VotingSessionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
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
Route::get('/forgot-password', [AuthController::class, 'resetPassword'])->name('resetPassword');

Route::prefix('auth')->name('auth')->group(function () {
    Route::post('signin', [AuthController::class, 'authSignIn'])->name('.signIn');
    Route::post('signup', [AuthController::class, 'authSignUp'])->name('.signUp');
    Route::post('reset-password', [AuthController::class, 'authResetPassword'])->name('.resetPassword');
    Route::get('signout', [AuthController::class, 'authLogout'])->name('.signOut');
});


Route::middleware(['auth:web'])->group(function () {

    Route::prefix('create')->name('create')->group(function () {
        Route::post('class', [ClassesController::class, 'store'])->middleware(['permission:Participant'])->name('.class');
        Route::post('user', [UserController::class, 'store'])->middleware(['permission:Participant'])->name('.user');
        Route::post('tps', [TpsController::class, 'store'])->middleware(['permission:TPS'])->name('.tps');
        Route::post('candidate', [CandidateController::class, 'store'])->middleware(['permission:Candidate'])->name('.candidate');
        Route::post('voting-session', [VotingSessionController::class, 'store'])->middleware(['permission:Voting Session'])->name('.votingSession');
        Route::get('registration/{session}/{user}', [PrecenceController::class, 'store'])->middleware(['permission:Registration'])->name('.precence');
        Route::get('voting/{candidate}/{user}', [VotingController::class, 'store'])->middleware(['permission:Voting'])->name('.voting');
    });

    Route::prefix('edit')->name('edit')->group(function () {
        Route::put('class/{classes}', [ClassesController::class, 'update'])->middleware(['permission:Participant'])->name('.class');
        Route::put('user/{user}', [UserController::class, 'update'])->middleware(['permission:Participant'])->name('.user');
        Route::put('tps/{user}', [TpsController::class, 'update'])->middleware(['permission:TPS'])->name('.tps');
        Route::put('candidate/{candidate}', [CandidateController::class, 'update'])->middleware(['permission:Candidate'])->name('.candidate');
        Route::put('voting-session/{votingSession}', [VotingSessionController::class, 'update'])->middleware(['permission:Voting Session'])->name('.votingSession');
        Route::put('setting', [DashboardController::class, 'settingEdit'])->middleware(['permission:Setting'])->name('.setting');
        Route::put('profile', [DashboardController::class, 'profileEdit'])->name('.profile');
    });

    Route::prefix('delete')->name('delete')->group(function () {
        Route::delete('class/{classes}', [ClassesController::class, 'destroy'])->middleware(['permission:Participant'])->name('.class');
        Route::delete('user/{user}', [UserController::class, 'destroy'])->middleware(['permission:Participant'])->name('.user');
        Route::delete('tps/{user}', [TpsController::class, 'destroy'])->middleware(['permission:TPS'])->name('.tps');
        Route::delete('candidate/{candidate}', [CandidateController::class, 'destroy'])->middleware(['permission:Candidate'])->name('.candidate');
        Route::delete('voting-session/{votingSession}', [VotingSessionController::class, 'destroy'])->middleware(['permission:Voting Session'])->name('.votingSession');
    });
});

Route::middleware(['auth:web'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->middleware(['permission:Dashboard'])->name('dashboard');

    Route::middleware(['permission:Participant'])->prefix('participant')->name('participant')->group(function () {
        Route::get('class', [ClassesController::class, 'index'])->name('.class');
        Route::get('class/edit/{classes}', [ClassesController::class, 'edit'])->name('.class.edit');

        Route::get('user', [UserController::class, 'index'])->name('.user');
        Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('.user.edit');
        Route::get('user/reset/{user}', [UserController::class, 'reset'])->name('.user.reset');

        Route::get('activation/{class?}', [UserController::class, 'activation'])->name('.activation');
        Route::get('activation/verify/{user}', [UserController::class, 'verify'])->name('.activation.verify');
    });

    Route::middleware(['permission:TPS'])->group(function () {
        Route::get('tps', [TpsController::class, 'index'])->name('tps');
        Route::get('tps/edit/{user}', [TpsController::class, 'edit'])->name('tps.edit');
    });

    Route::middleware(['permission:Candidate'])->group(function () {
        Route::get('candidate', [CandidateController::class, 'index'])->name('candidate');
        Route::get('candidate/edit/{candidate}', [CandidateController::class, 'edit'])->name('candidate.edit');
    });

    Route::middleware(['permission:Voting Session'])->group(function () {
        Route::get('voting-session', [VotingSessionController::class, 'index'])->name('votingSession');
        Route::get('voting-session/edit/{votingSession}', [VotingSessionController::class, 'edit'])->name('votingSession.edit');
    });

    Route::middleware(['permission:Registration'])->group(function () {
        Route::get('registration', [PrecenceController::class, 'index'])->name('registration');
        Route::get('registration/scan/{votingSession}', [PrecenceController::class, 'create'])->name('registration.scan');
    });

    Route::middleware(['permission:Voting'])->group(function () {
        Route::get('voting', [VotingController::class, 'index'])->name('voting');
        Route::get('voting/{user}', [VotingController::class, 'create'])->name('voting.ballotBox');
    });

    Route::get('dpt', [UserController::class, 'show'])->middleware(['permission:DPT'])->name('dpt');

    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');

    Route::get('setting', [DashboardController::class, 'setting'])->name('setting');

    Route::get('list-candidate', [CandidateController::class, 'show'])->middleware('role:Participant')->name('listCandidate');

    Route::get('reset-database', function () {
        Artisan::call('migrate:reset', ['--force' => true]);
        Artisan::call('migrate', ['--seed' => true, '--force' => true]);

        $directory = storage_path('app/public/assets/img/kandidat');

        if (File::exists($directory)) {
            File::deleteDirectory($directory);
        }

        toast('Successfully reset database', 'success')->autoClose(5000);
        return redirect()->route('login');
    })->name('resetDatabase');

    Route::get('clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('clear-compiled');

        toast('Successfully cleared cache', 'success')->autoClose(5000);
        return redirect()->back();
    })->name('clearCache');
});
