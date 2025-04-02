<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Models\Order_Beli;
use App\Models\User;
use App\Models\Produk;
use Yajra\DataTables\Facades\DataTables;

class PembelianController extends Controller
{
        /** 
     * Display a listing of the resource.
     */ 
    public function index()
    {
        return view('pembelian.riwayat');
    }
 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detail = Order_Beli::with('produk')->where('id_pembelian', $id)->get();

        return DataTables::of($detail)
            ->addIndexColumn() 
            ->addColumn('produk.id_produk', function ($detail) {
                return $detail->produk->id_produk;
            })
            ->addColumn('produk.nama', function ($detail) {
                return $detail->produk->nama;
            })
            ->addColumn('produk.harga_jual', function ($detail) {
                return $detail->produk->harga_jual;
            })
            ->addColumn('quantity', function ($detail) {
                return $detail->quantity;
            })
            ->addColumn('subtotal', function ($detail) {
                return $detail->subtotal;
            })
            ->make(true);
    }

    public function data()
    {
        $pembelian = Pembelian::with('user')->orderBy('id_pembelian', 'desc')->get();

        return DataTables::of($pembelian)
            ->addIndexColumn() 
            ->addColumn('tanggal', function ($pembelian) {
                return tanggal_indonesia($pembelian->updated_at);
            })
            ->addColumn('total_item', function ($pembelian) {
                return $pembelian->total_item;
            })
            ->addColumn('total_harga', function ($pembelian) {
                return 'Rp. '. format_uang($pembelian->total_harga);
            })
            ->addColumn('kasir', function ($pembelian) {
                return $pembelian->user->name;
            })
            ->addColumn('status', function ($pembelian) {
                $status = $pembelian->status ?? '';
                if($status == 'Selesai' || $status == 'Lunas'){
                    return '<span class="badge text-sm fw-semibold rounded-pill bg-success-600 px-20 py-9 radius-4 text-white">'. $status .'</span>';
                } else{
                    return '<span class="badge text-sm fw-semibold rounded-pill bg-warning-600 px-20 py-9 radius-4 text-white">'.$status.'</span>';
                }
            })
            ->addColumn('aksi', function ($pembelian) {
                return '
                <div class="d-flex align-items-center gap-10 justify-content-center">
                    <button type="button"
                        class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                        onclick="showDetail(`'. route('riwayatbeli.show', $pembelian->id_pembelian) .'`)">
                        <iconify-icon icon="mdi:eye-outline" class="menu-icon"></iconify-icon>
                    </button>
                    <button type="button"
                        class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle hapus-barang"
                        data-id="' . $pembelian->id_pembelian . '">
                        <iconify-icon icon="material-symbols:delete-outline" class="menu-icon"></iconify-icon>
                    </button>
                </div>
                ';
            })

            ->rawColumns(['aksi', 'status'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteItem(Request $request)
    {
        $pembelian = Pembelian::find($request->id_pembelian);
        if (!$pembelian) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
        $detail = Order_Beli::where('id_pembelian', $pembelian->id_pembelian)->get();

        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok -= $item->quantity;
                $produk->update();
            }

            $item->delete();
        }
    

        $pembelian->delete();
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}
