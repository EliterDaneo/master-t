<?php

use Illuminate\Support\Facades\Route;

//forntend
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/berita', [App\Http\Controllers\WelcomeController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}/detail', [App\Http\Controllers\WelcomeController::class, 'showBerita'])->name('berita.detail');
Route::get('/order', [App\Http\Controllers\WelcomeController::class, 'order'])->name('order');
Route::post('/order', [App\Http\Controllers\WelcomeController::class, 'storeOrder'])->name('order.store');
Route::get('/produk', [App\Http\Controllers\WelcomeController::class, 'produk'])->name('produk');
Route::get('/produk/{slug}/show', [App\Http\Controllers\WelcomeController::class, 'showProduk'])->name('show.produk');
Route::get('/kontak', [App\Http\Controllers\WelcomeController::class, 'kontak'])->name('kontak');

//login dan register
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [App\Http\Controllers\Auth\LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/proses-login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('proses.login');
Route::post('/proses-register', [App\Http\Controllers\Auth\LoginController::class, 'register'])->name('proses.register');

//dashboard
Route::prefix('admin')->group(function () {

    Route::group(['middleware' => 'auth'], function () {
        //logout
        Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('admin.logout');

        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');
        Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class, ['only' => ['create', 'store', 'update', 'destroy', 'index']]);
        Route::resource('/berita', App\Http\Controllers\Admin\BeritaController::class, ['only' => ['create', 'store', 'destroy', 'index']]);
        Route::get('/berita/{slug}/edit', [App\Http\Controllers\Admin\BeritaController::class, 'edit'])->name('berita.edit');
        Route::put('/berita/{slug}/update', [App\Http\Controllers\Admin\BeritaController::class, 'update'])->name('berita.update');
        Route::resource('order', \App\Http\Controllers\Admin\OrderController::class, ['only' => ['index']]);
        Route::resource('produk', \App\Http\Controllers\Admin\ProdukController::class, ['only' => ['create', 'store', 'destroy', 'index', 'edit', 'update']]);


        Route::group(['middleware' => 'admin'], function () {
            Route::resource('struktur', \App\Http\Controllers\Admin\StrukturController::class, ['only' => ['create', 'store', 'destroy', 'index', 'edit', 'update']]);
            Route::resource('vm', \App\Http\Controllers\Admin\VisiMisiController::class, ['only' => ['create', 'store', 'destroy', 'index', 'edit', 'update']]);
            Route::resource('slider', \App\Http\Controllers\Admin\SliderController::class, ['only' => ['store', 'destroy', 'index', 'update']]);
            Route::resource('dudi', \App\Http\Controllers\Admin\DudiController::class, ['only' => ['store', 'destroy', 'index', 'update']]);
            Route::resource('user', \App\Http\Controllers\Admin\UserController::class, ['only' => ['store', 'destroy', 'index', 'update']]);
        });
    });
});
