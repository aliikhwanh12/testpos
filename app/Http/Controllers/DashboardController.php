<?php

namespace App\Http\Controllers;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        public function index()
    {
        $trankjual = Penjualan::orderBy('updated_at', 'desc')->take(5)->get();
        $trankbeli = Pembelian::orderBy('updated_at', 'desc')->take(5)->get();

        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');

        $penjualan = 0;
        $totalpendapatan = 0;
        $pembelian = 0;
        $totalexpense = 0;
        $pengeluaran = 0;


        $data_tanggal = array();
        $data_penjualan = array();
        $data_pengeluaran = array();

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);

            $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('bayar');
            $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('bayar');
            $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('jumlah');

            $exp = $total_pembelian + $total_pengeluaran;
            $penjualan += $total_penjualan;
            $pembelian += $total_pembelian;
            $pengeluaran += $total_pengeluaran;
            $totalexpense += $exp;
            
            $pendapatan = $total_penjualan - $exp;
            $totalpendapatan += $pendapatan;
            $data_penjualan[] += $total_penjualan;
            $data_pengeluaran[] += $exp;

            $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }
        $data_piechart = [
            $penjualan,
            $pembelian,
            $pengeluaran
        ];
        $tanggal_awal = date('Y-m-01');
        return view('dashboard', compact('penjualan', 'totalpendapatan', 'pembelian', 'totalexpense', 'pengeluaran', 'tanggal_awal', 'tanggal_akhir', 'data_tanggal', 'data_penjualan', 'data_pengeluaran', 'data_piechart' , 'trankjual', 'trankbeli'));
    }//
}
