<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderJualController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;

Route::redirect('/', '/produk');

Route::prefix('produk')->group(function () {
    Route::get('/kategori', function(){
        return view('produk.kategoriProduk');
    })->name('kategoriproduk.index');
    Route::get('/', function(){
        return view('produk.produk');
    })->name('produk.index');
});


Route::prefix('sales')->group(function () {
    Route::get('/transaksi', function(){
        return view('penjualan.penjualan');
    })->name('orderjual.index');
    Route::get('/riwayat', function(){
        return view('penjualan.riwayat');
    })->name('riwayatjual.index');
});
