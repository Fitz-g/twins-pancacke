<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('admin.auth.login');
    })->name('login');

    Route::get('/', function () {
        return view('admin.auth.login');
    })->name('login');

    Route::post('login', [Controllers\AuthController::class, 'auth'])->name('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('home', [Controllers\DashboardController::class, 'home'])->name('dashboard');
    Route::get('logout', [Controllers\AuthController::class, 'logout'])->name('logout');
    Route::resources([
        "products" => Controllers\ProductController::class,
    ]);
});
