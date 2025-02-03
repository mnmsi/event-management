<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    // Categories
    Route::resource('categories', CategoryController::class);
    // Events
    Route::resource('events', EventController::class);
    // Add participant to event
    Route::post('events/{event}/participants', [EventController::class, 'addParticipant'])->name('events.participants.add');
});
