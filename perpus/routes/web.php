<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserBukuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

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
//Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1'); 

// Route::middleware(['block.ip'])->group(function () {
//     Route::post('/login', [AuthController::class, 'login'])->name('login');
//     //Route::get('/some-protected-route', [SomeController::class, 'method']);
// });


// -------------------
// LOGOUT
// -------------------
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ADMIN ROUTES------------------------------------------------------------
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::resource('/admin/bukus', BukuController::class);
// Profile
Route::get('/admin/profil', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/admin/profil/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/admin/profil', [ProfileController::class, 'update'])->name('profile.update');

// USER ROUTES--------------------------------------------------------------
Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('/user/buku/{id}', [UserBukuController::class, 'show'])->name('user.bukus.show');
// Profile
Route::get('/user/profil', [ProfileController::class, 'show'])->name('user.profil.show');
Route::get('/user/profil/{id}/edit', [ProfileController::class, 'edit'])->name('user.profil.edit');
Route::put('/user/profil', [ProfileController::class, 'update'])->name('user.profil.update');


// -------------------
// HALAMAN DASHBOARD SESUAI ROLE
// -------------------
/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
// Route::middleware(['auth', 'checkRole:admin'])->group(function () {
//     Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
//     Route::resource('/admin/bukus', BukuController::class);

//     // Profile
//     Route::get('/admin/profil', [ProfileController::class, 'show'])->name('profile.show');
//     Route::get('/admin/profil/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::put('/admin/profil', [ProfileController::class, 'update'])->name('profile.update');
// });
// /*
// |--------------------------------------------------------------------------
// | USER ROUTES
// |--------------------------------------------------------------------------
// */
// Route::middleware(['auth', 'checkRole:user'])->group(function () {
//     Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
//     // Route::get('/user/bukus', [UserBukuController::class, 'index'])->name('user.bukus.index');
//     Route::get('/user/buku/{id}', [UserBukuController::class, 'show'])->name('user.bukus.show');

//     // Profile
//     Route::get('/user/profil', [ProfileController::class, 'show'])->name('user.profil.show');
//     Route::get('/user/profil/{id}/edit', [ProfileController::class, 'edit'])->name('user.profil.edit');
//     Route::put('/user/profil', [ProfileController::class, 'update'])->name('user.profil.update');
// });
