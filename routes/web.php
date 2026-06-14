<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;

// Rota pública do site (home)
Route::get('/', [PageController::class, 'home'])->name('home');

// Detalhe do pacote de viagem
Route::get('/pacote/{slug}', [PageController::class, 'destinationShow'])->name('destination.show');
Route::get('/pacotes', [PageController::class, 'destinations'])->name('destination');

// Páginas institucionais
Route::get('/nossos-servicos', [PageController::class, 'services'])->name('services');
Route::get('/servicos/{slug}', [PageController::class, 'serviceShow'])->name('service.show');
Route::get('/pacotes-2026-2027', [PageController::class, 'packages20262027'])->name('packages20262027');
Route::get('/bate-e-volta', [PageController::class, 'shortTrips'])->name('short-trips');
Route::get('/viagens-em-grupo', [PageController::class, 'groupTrips'])->name('group-trips');
Route::get('/perguntas-frequentes', [PageController::class, 'faq'])->name('faq');
Route::get('/contato', [PageController::class, 'contact'])->name('contact');
Route::post('/contato', [PageController::class, 'submitContact'])->name('contact.submit');

// Autenticação do Administrador
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Painel Administrativo Protegido
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD Configurações Gerais
    Route::get('/settings', [AdminController::class, 'banners'])->name('admin.settings.index');
    Route::get('/settings/{setting}/edit', [AdminController::class, 'settingEdit'])->name('admin.settings.edit');
    Route::put('/settings/{setting}', [AdminController::class, 'settingUpdate'])->name('admin.settings.update');

    // CRUD Banners
    Route::get('/banners', [AdminController::class, 'banners'])->name('admin.banners.index');
    Route::get('/banners/{banner}/edit', [AdminController::class, 'bannerEdit'])->name('admin.banners.edit');
    Route::get('/banners/create', [AdminController::class, 'bannerCreate'])->name('admin.banners.create');
    Route::post('/banners', [AdminController::class, 'bannerStore'])->name('admin.banners.store');
    Route::put('/banners/{banner}', [AdminController::class, 'bannerUpdate'])->name('admin.banners.update');

    Route::delete('/feature-banner/{featureBanner}', [AdminController::class, 'featureBannerDelete'])->name('admin.feature-banner.delete');
    Route::delete('/button-banner/{buttonBanner}', [AdminController::class, 'buttonBannerDelete'])->name('admin.button-banner.delete');
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

    // CRUD Serviços
    Route::get('/services', [AdminController::class, 'services'])->name('admin.services.index');
    Route::get('/services/create', [AdminController::class, 'serviceCreate'])->name('admin.services.create');
    Route::post('/services', [AdminController::class, 'serviceStore'])->name('admin.services.store');
    Route::get('/services/{service}/edit', [AdminController::class, 'serviceEdit'])->name('admin.services.edit');
    Route::put('/services/{service}', [AdminController::class, 'serviceUpdate'])->name('admin.services.update');
    Route::delete('/services/{service}', [AdminController::class, 'serviceDestroy'])->name('admin.services.destroy');

    // Pages
    Route::get('/pages', [AdminController::class, 'pages'])->name('admin.pages.index');
    Route::get('/pages/create', [AdminController::class, 'pageCreate'])->name('admin.pages.create');
    Route::post('/pages', [AdminController::class, 'pageStore'])->name('admin.pages.store');
    Route::get('/pages/{page}/edit', [AdminController::class, 'pageEdit'])->name('admin.pages.edit');
    Route::put('/pages/{page}', [AdminController::class, 'pageUpdate'])->name('admin.pages.update');
    Route::delete('/pages/{page}', [AdminController::class, 'pageDestroy'])->name('admin.pages.destroy');
});
