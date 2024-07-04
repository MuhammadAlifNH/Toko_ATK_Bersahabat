<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProdukController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/user/profile', [AuthController::class, 'profile'])->name('user.profile');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Route untuk kategori produk
    Route::get('/kategori-produk', [KategoriProdukController::class, 'index'])->name('kategori.index');
    Route::get('/kategori-produk/create', [KategoriProdukController::class, 'create'])->name('kategori.create');
    Route::post('/kategori-produk/store', [KategoriProdukController::class, 'store'])->name('kategori.store');
    Route::get('/kategori-produk/{kategori}/edit', [KategoriProdukController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori-produk/{kategori}/update', [KategoriProdukController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori-produk/{kategori}/destroy', [KategoriProdukController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/kategori-produk/{id}/confirm', [KategoriProdukController::class, 'confirm'])->name('kategori.confirm');

    // Route untuk produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{produk}/update', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{produk}/destroy', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/produk/{id}/confirm', [ProdukController::class, 'confirm'])->name('produk.confirm');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});



