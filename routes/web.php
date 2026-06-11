<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PendingController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\RiwayatAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/home', function () {
        return view('home');
    });
});

Route::get('/pusat-bantuan', function () {
    return view('user.help');
})->name('help');

Route::middleware(['auth'])->group(function () {

    Route::get('/profil',
        [ProfileController::class, 'edit'])
        ->name('profil');

    Route::post('/profil/update',
        [ProfileController::class, 'update'])
        ->name('profil.update');

});

Route::get('/admin/laporan',
    [LaporanController::class, 'index'])
    ->name('admin.laporan');
    
Route::get('/pembayaran', [PesananController::class, 'pembayaran'])
    ->name('pembayaran');

Route::get('/tracking', [PesananController::class, 'tracking'])
    ->name('tracking');

Route::get('/riwayat', [PesananController::class, 'riwayat'])
    ->name('riwayat');
    
Route::get('/admin/riwayat',
    [RiwayatAdminController::class, 'index'])
    ->name('admin.riwayat');

Route::get('/admin/pesanan',
    [AdminPesananController::class, 'index'])
    ->name('admin.pesanan');

Route::post('/admin/pesanan/{id}/completed',
    [AdminPesananController::class, 'completed'])
    ->name('admin.pesanan.completed');
    
Route::post('/pesanan/{id}/cancel',
    [PesananController::class, 'cancel'])
    ->name('pesanan.cancel');

Route::post('/admin/orders/{id}/accept',
    [PendingController::class, 'accept'])
    ->name('admin.orders.accept');

Route::post('/admin/orders/{id}/reject',
    [PendingController::class, 'reject'])
    ->name('admin.orders.reject');
    
Route::get('/admin/pending',
    [PendingController::class, 'index'])
    ->name('orders.pending');
    
Route::post('/pesanan/upload/{id}',
    [PesananController::class, 'uploadPayment'])
    ->name('pesanan.upload');
    
Route::post('/checkout', [CheckoutController::class, 'checkout'])
    ->name('checkout');

Route::delete('/cart/{id}', [CartController::class, 'destroy'])
    ->name('cart.destroy');

Route::patch('/cart/{id}/increase', [CartController::class, 'increase'])
    ->name('cart.increase');

Route::patch('/cart/{id}/decrease', [CartController::class, 'decrease'])
    ->name('cart.decrease');

Route::post('/cart/store',
    [CartController::class, 'store'])
    ->name('cart.store');

Route::get('/cart',
    [CartController::class, 'index'])
    ->name('cart.index');

Route::delete('/admin/product-image/{id}',
    [ProductController::class, 'deleteImage'])
    ->name('product.image.delete');
    
Route::get('/menu', [ProductController::class, 'menu'])
    ->name('menu.index');
    
Route::get('/admin/customer', [CustomerController::class, 'index'])
    ->name('admin.customer');
    
Route::delete('/admin/product/{id}', [ProductController::class, 'destroy'])
    ->name('product.delete');

Route::get('/admin/product/{id}/edit',
    [ProductController::class, 'edit'])
    ->name('product.edit');

Route::put('/admin/product/{id}', [ProductController::class, 'update'])
    ->name('product.update');

Route::get('/admin/product', [ProductController::class, 'index'])
    ->name('product.index');

Route::get('/admin/tambah-produk', [ProductController::class, 'create'])
    ->name('admin.tambah-produk');

Route::post('/admin/tambah-produk', [ProductController::class, 'store'])
    ->name('product.store');

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

});

/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/admin',
    [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

require __DIR__.'/auth.php';