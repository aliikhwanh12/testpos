<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function kelolaAkun()
    {
        return view('usersList');
    }

    public function kelolaProduk()
    {
        return view('produk');
    }

    public function sale()
    {
        return view('penjualan');
    }

    public function purchase()
    {
        return view('pembelian');
    }

    public function expense()
    {
        return view('pengeluaran');
    }

    public function cat_product()
    {
        return view('kategoriProduk');
    }

    public function cat_expense()
    {
        return view('kategoriExpense');
    }

    public function saleReport()
    {
        return view('laporanPenjualan');
    }

    public function purchaseReport()
    {
        return view('laporanPembelian');
    }

    public function expenseReport()
    {
        return view('laporanPengeluaran');
    }

    public function profitReport()
    {
        return view('laporanPendapatan');
    }
}
