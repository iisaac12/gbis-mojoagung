<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\HeroImageController as AdminHeroImageController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;

// Public Routes
Route::get('/', [HomeController::class , 'index'])->name('home');
Route::get('/about', [AboutController::class , 'index'])->name('about');
Route::get('/schedules', [ScheduleController::class , 'index'])->name('schedules');
Route::get('/events', [EventController::class , 'index'])->name('events');
Route::get('/events/{slug}', [EventController::class , 'show'])->name('events.show');
Route::get('/contact', [ContactController::class , 'index'])->name('contact');
Route::post('/contact', [ContactController::class , 'store'])->name('contact.store');

// Authentication Routes
Route::get('/login', [LoginController::class , 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class , 'login']);
Route::post('/logout', [LoginController::class , 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class , 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class , 'register']);

// Admin Routes (Protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class , 'index'])->name('admin.dashboard');

    // Services Management
    Route::resource('services', AdminServiceController::class)->except(['show'])->names([
        'index' => 'admin.services.index',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);

    // Events Management
    Route::resource('events', AdminEventController::class)->names([
        'index' => 'admin.events.index',
        'create' => 'admin.events.create',
        'store' => 'admin.events.store',
        'show' => 'admin.events.show',
        'edit' => 'admin.events.edit',
        'update' => 'admin.events.update',
        'destroy' => 'admin.events.destroy',
    ]);

    // Hero Management
    Route::resource('heroes', AdminHeroImageController::class)->except(['show', 'edit', 'update'])->names([
        'index' => 'admin.heroes.index',
        'create' => 'admin.heroes.create',
        'store' => 'admin.heroes.store',
        'destroy' => 'admin.heroes.destroy',
    ]);

    // Contact Messages
    Route::get('/contacts', [AdminContactController::class , 'index'])->name('admin.contacts.index');
    Route::get('/contacts/{id}', [AdminContactController::class , 'show'])->name('admin.contacts.show');
    Route::post('/contacts/{id}/reply', [AdminContactController::class , 'reply'])->name('admin.contacts.reply');
    Route::delete('/contacts/{id}', [AdminContactController::class , 'destroy'])->name('admin.contacts.destroy');
});