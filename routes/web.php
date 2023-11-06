<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');
    Route::get('/blog/{slug}', [HomeController::class, 'blog'])->name('blog');
});

// Add language switching routes
foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
    Route::prefix($localeCode)->group(function () use ($localeCode) {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');
    });
};
