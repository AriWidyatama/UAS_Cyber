<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
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


// Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// // Route::resource('kategoris', KategoriController::class);

// Route::resource('bukus', BukuController::class);


// -------------------
// HALAMAN DASHBOARD SESUAI ROLE
// -------------------
Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('bukus', BukuController::class);
});

// Route::middleware(['auth', 'checkRole:user'])->group(function () {
//     Route::get('/user/dashboard', [DashboardController::class, 'userIndex'])->name('user.dashboard');
// });

// Route::get('/dashboard', function () {
//     return 'Halaman Dashboard';
// })->middleware('cekrole:admin,user');
