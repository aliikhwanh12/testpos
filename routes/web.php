<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OrderJualController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

Route::redirect('/', '/produk/index');
Route::prefix('products')->group(function () {
    Route::resource('/kategoriproduk', KategoriProdukController::class);
    Route::resource('/produk', ProdukController::class);
});
Route::prefix('sales')->group(function () {
    Route::resource('/transaksi', OrderJualController::class)->name('index', 'orderjual.index')->name('store', 'orderjual.store')->except('create', 'show', 'edit', 'update', 'destroy');
    Route::delete('/order/delete-all', [OrderJualController::class, 'deleteAll'])->name('orderjual.deleteAll');
    Route::post('/order/updateQTY', [OrderJualController::class, 'updateQuantity'])->name('orderjual.updateQuantity');
    Route::post('/order/deleteItem', [OrderJualController::class, 'deleteItem'])->name('orderjual.deleteItem');
    Route::get('/order/data', [OrderJualController::class, 'data'])->name('orderjual.data');
    Route::get('/order/total-harga', [OrderJualController::class, 'getTotalHarga'])->name('orderjual.totalHarga');
    Route::post('/order/checkout', [OrderJualController::class, 'checkout'])->name('orderjual.checkout');
    Route::get('/struk/{id}', [PenjualanController::class, 'struk'])->name('penjualan.struk');
    Route::resource('/riwayat', PenjualanController::class)->name('index', 'riwayatjual.index')->name('show', 'riwayatjual.show')->except('create', 'store', 'edit', 'update', 'destroy');
    Route::get('/history/data', [PenjualanController::class, 'data'])->name('riwayatjual.data');
    Route::post('/history/deleteitem', [PenjualanController::class, 'deleteItem'])->name('riwayatjual.deleteItem');
});

Route::resource('/laporan', LaporanController::class);
Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
Route::resource('/manageakun', UserController::class);



Auth::routes();
