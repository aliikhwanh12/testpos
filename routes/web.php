<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ComponentpageController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoleandaccessController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\KategoriExpController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\OrderBeliController;
use App\Http\Controllers\OrderJualController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Models\Penjualan;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/widget', [HomeController::class, 'widgets'])->name('widgets');
    Route::get('/error', [HomeController::class, 'error1'])->name('error');
    Route::get('/blank', [HomeController::class, 'blankPage'])->name('blankPage');
Route::prefix('products')->group(function () {
    Route::resource('/kategoriproduk', KategoriProdukController::class);
    Route::resource('/produk', ProdukController::class);
});

Route::prefix('expenses')->group(function () {
    Route::resource('/kategoriexp', KategoriExpController::class);
    Route::resource('/pengeluaran', PengeluaranController::class);
});

Route::prefix('purchases')->group(function () {
    Route::resource('/transaksi', OrderBeliController::class)->name('index', 'orderbeli.index')->name('store', 'orderbeli.store')->except('create', 'show', 'edit', 'update', 'destroy');
    Route::delete('/order/delete-all', [OrderBeliController::class, 'deleteAll'])->name('orderbeli.deleteAll');
    Route::post('/order/updateQTY', [OrderBeliController::class, 'updateQuantity'])->name('orderbeli.updateQuantity');
    Route::post('/order/deleteItem', [OrderBeliController::class, 'deleteItem'])->name('orderbeli.deleteItem');
    Route::get('/order/data', [OrderBeliController::class, 'data'])->name('orderbeli.data');
    Route::get('/order/total-harga', [OrderBeliController::class, 'getTotalHarga'])->name('orderbeli.totalHarga');
    Route::post('/order/checkout', [OrderBeliController::class, 'checkout'])->name('orderbeli.checkout');
    Route::resource('/riwayat', PembelianController::class)->name('index', 'riwayatbeli.index')->name('show', 'riwayatbeli.show')->except('create', 'store', 'edit', 'update', 'destroy');
    Route::get('/history/data', [PembelianController::class, 'data'])->name('riwayatbeli.data');
    Route::post('/history/deleteitem', [PembelianController::class, 'deleteItem'])->name('riwayatbeli.deleteItem');
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

Route::resource('/manageakun', UserController::class);


// Route::prefix('dashboard')->group(function () {
//     Route::controller(HomeController::class)->group(function () {
//         Route::get('/', 'index')->name('index');
//     });
// });
    
// chart
Route::prefix('chart')->group(function () {
    Route::controller(ChartController::class)->group(function () {
        Route::get('/columnchart', 'columnChart')->name('columnChart');
        Route::get('/linechart', 'lineChart')->name('lineChart');
        Route::get('/piechart', 'pieChart')->name('pieChart');
    });
});
    
// Componentpage
Route::prefix('componentspage')->group(function () {
    Route::controller(ComponentpageController::class)->group(function () {
        Route::get('/alert', 'alert')->name('alert');
        Route::get('/avatar', 'avatar')->name('avatar');
        Route::get('/badges', 'badges')->name('badges');
        Route::get('/button', 'button')->name('button');
        Route::get('/calendar', 'calendar')->name('calendar');
        Route::get('/card', 'card')->name('card');
        Route::get('/carousel', 'carousel')->name('carousel');
        Route::get('/colors', 'colors')->name('colors');
        Route::get('/dropdown', 'dropdown')->name('dropdown');
        Route::get('/imageupload', 'imageUpload')->name('imageUpload');
        Route::get('/list', 'list')->name('list');
        Route::get('/pagination', 'pagination')->name('pagination');
        Route::get('/progress', 'progress')->name('progress');
        Route::get('/radio', 'radio')->name('radio');
        Route::get('/starrating', 'starRating')->name('starRating');
        Route::get('/switch', 'switch')->name('switch');
        Route::get('/tabs', 'tabs')->name('tabs');
        Route::get('/tags', 'tags')->name('tags');
        Route::get('/tooltip', 'tooltip')->name('tooltip');
        Route::get('/typography', 'typography')->name('typography');
        Route::get('/videos', 'videos')->name('videos');
    });
});

// Forms
Route::prefix('forms')->group(function () {
    Route::controller(FormsController::class)->group(function () {
        Route::get('/form-layout', 'formLayout')->name('formLayout');
        Route::get('/form-validation', 'formValidation')->name('formValidation');
        Route::get('/form', 'form')->name('form');
        Route::get('/wizard', 'wizard')->name('wizard');
    });
});

// Table
Route::prefix('table')->group(function () {
    Route::controller(TableController::class)->group(function () {
        Route::get('/tablebasic', 'tableBasic')->name('tableBasic');
        Route::get('/tabledata', 'tableData')->name('tableData');
    });
});

// Users
Route::prefix('users')->group(function () {
    Route::controller(UsersController::class)->group(function () {
        Route::get('/add-user', 'addUser')->name('addUser');
        Route::get('/users-grid', 'usersGrid')->name('usersGrid');
        Route::get('/users-list', 'usersList')->name('usersList');
        Route::get('/view-profile', 'viewProfile')->name('viewProfile');
    });
});

// Users
Route::prefix('roleandaccess')->group(function () {
    Route::controller(RoleandaccessController::class)->group(function () {
        Route::get('/assignRole', 'assignRole')->name('assignRole');
        Route::get('/roleAaccess', 'roleAaccess')->name('roleAaccess');
    });
});
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
