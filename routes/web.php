<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminSectionController;
use App\Http\Controllers\PortfolioController;
use App\Http\Middleware\PortfolioAdmin;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::get('/', [PortfolioController::class, 'index']);
Route::post('/kesan-pesan', [PortfolioController::class, 'sendMessage'])
    ->middleware('throttle:5,10')
    ->name('feedback.send');

// Login & dashboard admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::post('/admin', [AdminController::class, 'index'])->name('admin.login');

// Semua perubahan konten wajib login (session portfolio_admin).
Route::middleware(PortfolioAdmin::class)->prefix('admin')->group(function () {
    Route::post('about', [AdminController::class, 'saveAbout'])->name('admin.about');
    Route::post('profile', [AdminController::class, 'saveProfile'])->name('admin.profile');
    Route::post('photo', [AdminController::class, 'savePhoto'])->name('admin.photo');
    Route::post('socials', [AdminController::class, 'saveSocials'])->name('admin.socials');
    Route::post('cv', [AdminController::class, 'saveCv'])->name('admin.cv');

    Route::post('message/read', [AdminController::class, 'readMessage'])->name('admin.message.read');
    Route::post('message/delete', [AdminController::class, 'deleteMessage'])->name('admin.message.delete');

    // CRUD section: skill, interest, project, education, experience, certificate, learning-log, testimonial
    foreach (array_keys(config('portfolio.sections')) as $slug) {
        foreach (['add', 'edit', 'delete'] as $action) {
            Route::post("{$slug}/{$action}", [AdminSectionController::class, $action])
                ->defaults('section', $slug)
                ->name("admin.{$slug}.{$action}");
        }
    }
});
