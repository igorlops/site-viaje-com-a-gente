<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Rota pública do site (home)
Route::get('/', [SiteController::class, 'home'])->name('home');

// Autenticação do Administrador
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Painel Administrativo Protegido
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD Banners
    Route::get('/banners', [AdminController::class, 'banners'])->name('admin.banners.index');
    Route::get('/banners/{banner}/edit', [AdminController::class, 'bannerEdit'])->name('admin.banners.edit');
    Route::put('/banners/{banner}', [AdminController::class, 'bannerUpdate'])->name('admin.banners.update');

    // CRUD Destinos
    Route::get('/destinations', [AdminController::class, 'destinations'])->name('admin.destinations.index');
    Route::get('/destinations/create', [AdminController::class, 'destinationCreate'])->name('admin.destinations.create');
    Route::post('/destinations', [AdminController::class, 'destinationStore'])->name('admin.destinations.store');
    Route::get('/destinations/{destination}/edit', [AdminController::class, 'destinationEdit'])->name('admin.destinations.edit');
    Route::put('/destinations/{destination}', [AdminController::class, 'destinationUpdate'])->name('admin.destinations.update');
    Route::delete('/destinations/{destination}', [AdminController::class, 'destinationDestroy'])->name('admin.destinations.destroy');

    // CRUD Redes Sociais
    Route::get('/social', [AdminController::class, 'socialLinks'])->name('admin.social.index');
    Route::post('/social', [AdminController::class, 'socialStore'])->name('admin.social.store');
    Route::put('/social/{socialLink}', [AdminController::class, 'socialUpdate'])->name('admin.social.update');
    Route::delete('/social/{socialLink}', [AdminController::class, 'socialDestroy'])->name('admin.social.destroy');
});
