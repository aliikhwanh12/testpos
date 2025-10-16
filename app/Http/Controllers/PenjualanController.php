<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Order_Jual;
use App\Models\User;
use App\Models\Produk;
use Yajra\DataTables\Facades\DataTables;
use function Pest\Laravel\json;

class PenjualanController extends Controller
{
    /** 
     * Display a listing of the resource.
     */ 
    public function index()
    {
        return view('penjualan.riwayat');
    }
 
    public function struk($id)
    {
        $penjualan = Penjualan::where('id', $id)->first();
        if (! $penjualan) {
            abort(404);
        }
        $detail = Order_Jual::with('produk')
            ->where('id_penjualan', $penjualan->id_penjualan)
            ->get();
        
        return view('penjualan.struk', compact('penjualan', 'detail'));
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
        $detail = Order_Jual::with('produk')->where('id_penjualan', $id)->get();

        return DataTables::of($detail)
            ->addIndexColumn() 
            ->addColumn('produk.id', function ($detail) {
                return $detail->produk->id;
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
        $penjualan = Penjualan::with('user')->orderBy('id', 'desc')->get();

        return DataTables::of($penjualan)
            ->addIndexColumn() 
            ->addColumn('tanggal', function ($penjualan) {
                return tanggal_indonesia($penjualan->updated_at);
            })
            ->addColumn('total_item', function ($penjualan) {
                return $penjualan->total_item;
            })
            ->addColumn('total_harga', function ($penjualan) {
                return 'Rp. '. format_uang($penjualan->total_harga);
            })
            ->addColumn('status', function ($penjualan) {
                $status = $penjualan->status ?? '';
                if($status == 'Selesai' || $status == 'Lunas'){
                    return '<span class="badge text-sm fw-semibold rounded-pill bg-success-600 px-20 py-9 radius-4 text-white">'. $status .'</span>';
                } else{
                    return '<span class="badge text-sm fw-semibold rounded-pill bg-warning-600 px-20 py-9 radius-4 text-white">'.$status.'</span>';
                }
            })
            ->addColumn('aksi', function ($penjualan) {
                return '
                <div class="d-flex align-items-center gap-10 justify-content-center">
                    <button type="button"
                        class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                        onclick="showDetail(`'. route('riwayatjual.show', $penjualan->id) .'`)">
                        <iconify-icon icon="mdi:eye-outline" class="menu-icon"></iconify-icon>
                    </button>
                    <button type="button"
                        class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                        data-bs-toggle="modal" data-bs-target="" onclick="struk(`/sales/struk/'.$penjualan->id.'`, `struk`)">
                        <iconify-icon icon="material-symbols:print-outline-rounded" class="menu-icon"></iconify-icon>
                    </button>
                    <button type="button"
                        class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle hapus-barang"
                        data-id="' . $penjualan->id . '">
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
        $penjualan = Penjualan::find($request->id_penjualan);
        if (!$penjualan) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
        $detail = Order_Jual::where('id_penjualan', $penjualan->id_penjualan)->get();

        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok += $item->quantity;
                $produk->update();
            }

            $item->delete();
        }
    

        $penjualan->delete();
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}
