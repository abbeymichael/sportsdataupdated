<?php

use App\Livewire\PlayerShow;

use App\Livewire\PlayerManager;
use App\Livewire\Club\ClubManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\TechnicalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', [HomePageController::class, 'index'])->name('home.index');

Route::get('/player/{id}', [HomePageController::class, 'player'])->name('player.show');



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Password reset routes
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Clubs
    Route::get('/clubs', ClubManager::class)->name('clubs.index');
    Route::get('/players', PlayerManager::class)->name('players.index');
    Route::get('/players/{player}', PlayerShow::class)->name('admin.player.show');
    
    // Technical skills
    Route::get('/technical', [TechnicalController::class, 'index'])->name('technical.index');
    Route::get('/tactical', [TechnicalController::class, 'tacticalIndex'])->name('tactical.index');
    Route::get('/mental', [TechnicalController::class, 'mentalIndex'])->name('mental.index');
    Route::get('/physical', [TechnicalController::class, 'physicalIndex'])->name('physical.index');
});
