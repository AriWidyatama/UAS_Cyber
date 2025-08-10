<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
=======
use App\Http\Controllers\AuthController;

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

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::resource('kategoris', KategoriController::class);

Route::resource('bukus', BukuController::class);
=======
// -------------------
// HALAMAN FORM LOGIN & REGISTER
// -------------------
Route::get('/', [AuthController::class, 'hal_login'])->name('login.form');
Route::get('/register', [AuthController::class, 'hal_regis'])->name('register.form');

// -------------------
// PROSES REGISTER & LOGIN
// -------------------
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// -------------------
// LOGOUT
// -------------------
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -------------------
// HALAMAN DASHBOARD SESUAI ROLE
// -------------------
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('/user', function () {
        return view('user.index');
    })->name('user.index');
});
