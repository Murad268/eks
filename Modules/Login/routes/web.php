<?php

use Illuminate\Support\Facades\Route;
use Modules\Login\app\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('admin:')->prefix('admin')->group(function () {
    Route::resource('/login', LoginController::class);
});

Route::post('admin/checkout', [LoginController  ::class, 'checkout'])->name('admin.checkout');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

