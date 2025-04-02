<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function saleReport()
    {
        return view('laporan/laporanPenjualan');
    }

    public function purchaseReport()
    {
        return view('laporan/laporanPembelian');
    }

    public function expenseReport()
    {
        return view('laporan/laporanPengeluaran');
    }

    public function profitReport()
    {
        return view('laporan/laporanPendapatan');
    }
}
