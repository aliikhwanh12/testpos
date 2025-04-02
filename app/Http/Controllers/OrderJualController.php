<?php

namespace App\Http\Controllers;

use App\Models\Order_Jual;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderJualController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek apakah sesi id_penjualan sudah ada
        if (!Session::has('id_penjualan')) {
            // Jika tidak ada, buat transaksi baru
            $penjualan = Penjualan::create([
                'id_user' => Auth::id(),
                'total_item' => 0,
                'total_harga' => 0,
                'bayar' => 0,
                'metode' => 'cash', // Akan diisi saat checkout
                'status' => 'Pending'
            ]);
    
            // Simpan id_penjualan ke session
            Session::put('id_penjualan', $penjualan->id_penjualan);
        } else {
            // Jika sudah ada, ambil dari database
            $penjualan = Penjualan::where('id_penjualan', Session::get('id_penjualan'))->firstOrFail();
        }
    
        // Ambil data order yang sudah ditambahkan ke transaksi ini
        $orders = Order_Jual::with('produk')->where('id_penjualan', $penjualan->id_penjualan)->get();
        $produk = Produk::paginate(10);
        return view('penjualan/penjualan', compact('penjualan', 'orders', 'produk'));
    }

    public function data()
    {
    $id_penjualan = Session::get('id_penjualan'); // Ambil ID transaksi dari session
    $orders = Order_Jual::with('produk')->where('id_penjualan', $id_penjualan)->get();

    return DataTables::of($orders)->addIndexColumn()
        ->addColumn('produk.nama', function ($orders) {
            return $orders->produk->nama ?? '-';
        })
        ->addColumn('produk.harga_jual', function ($orders) {
            return 'Rp ' . number_format($orders->produk->harga_jual, 0, ',', '.');
        })
        ->addColumn('quantity', function ($orders) {
            return '<input type="number" class="quantity form-control input-sm" data-id="' . $orders->id_orderJual . '" value="' . $orders->quantity . '" min="1">';
        })
        ->addColumn('subtotal', function ($orders) {
            return 'Rp ' . number_format($orders->subtotal, 0, ',', '.');
        })
        ->addColumn('aksi', function ($orders) {
            return '<button type="button" class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle hapus-barang" data-bs-toggle="modal" data-id="' . $orders->id_orderJual . '"><iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon></button>';
        })
        ->rawColumns(['quantity', 'aksi'])
        ->make(true);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $id_penjualan = Session::get('id_penjualan');
    // Cek apakah produk dengan ID tersebut ada di database
    $produk = Produk::find($request->id_produk);
    if (!$produk) {
        return response()->json(['success' => false]);
    } 

    // Cek apakah produk sudah ada dalam order
    $existingOrder = Order_Jual::where('id_penjualan', $id_penjualan)
                                   ->where('id_produk', $request->id_produk)
                                   ->first();

    if ($existingOrder) {
        // Jika sudah ada, tambahkan quantity
        $existingOrder->quantity += 1;
        $existingOrder->subtotal = $produk->harga_jual * $existingOrder->quantity;
        $existingOrder->save();
    } else {
        // Jika belum ada, tambahkan sebagai order baru dengan quantity = 1
        Order_Jual::create([
            'id_penjualan' => $id_penjualan,
            'id_produk' => $request->id_produk,
            'quantity' => 1,
            'subtotal' => $produk->harga_jual,
        ]);
    }
    $penjualan = Penjualan::find($id_penjualan);
    if ($penjualan) {
        // Hitung ulang total harga & total item dalam transaksi
        $total_harga = Order_Jual::where('id_penjualan', $id_penjualan)->sum('subtotal');
        $total_item = Order_Jual::where('id_penjualan', $id_penjualan)->sum('quantity');

        $penjualan->total_harga = $total_harga;
        $penjualan->total_item = $total_item;
        $penjualan->save();
    }
    return response()->json([
        'success' => true,
        'message' => 'Produk berhasil ditambahkan'
    ]);
}


    public function deleteAll(Request $request)
    {
        $id_penjualan = Session::get('id_penjualan'); // Ambil ID penjualan dari session
    
        // Hapus semua order beli berdasarkan id_penjualan
        Order_Jual::where('id_penjualan', $id_penjualan)->delete();
    
        // Set ulang total harga & total item di tabel penjualan
        $penjualan = Penjualan::find($id_penjualan);
        if ($penjualan) {
            $penjualan->total_harga = 0;
            $penjualan->total_item = 0;
            $penjualan->save();
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Semua item dalam transaksi telah dihapus'
        ]);
    }

    public function updateQuantity(Request $request)
{
    $order = Order_Jual::findOrFail($request->id_orderjual);
    $penjualan = Penjualan::findOrFail($order->id_penjualan);
 
    // Update quantity dan subtotal
    $order->quantity = $request->quantity;
    $order->subtotal = $order->produk->harga_jual * $request->quantity;
    $order->save();

    // Update total harga transaksi
    $penjualan->total_harga = Order_Jual::where('id_penjualan', $penjualan->id_penjualan)->sum('subtotal');
    $penjualan->total_item = Order_Jual::where('id_penjualan', $penjualan->id_penjualan)->sum('quantity');
    $penjualan->save();

    return response()->json([
        'success' => true,
        'message' => 'Produk berhasil ditambahkan'
    ]);
}

public function deleteItem(Request $request)
{
    $order = Order_Jual::findOrFail($request->id_orderjual);
    $penjualan = Penjualan::findOrFail($order->id_penjualan);

    // Hapus item
    $order->delete();

    // Update total harga setelah item dihapus
    $penjualan->total_harga = Order_Jual::where('id_penjualan', $penjualan->id_penjualan)->sum('subtotal');
    $penjualan->total_item = Order_Jual::where('id_penjualan', $penjualan->id_penjualan)->sum('quantity');
    $penjualan->save();

    return response()->json([
        'success' => true,
        'message' => 'Produk berhasil dihapus'
    ]);
}

public function getTotalHarga()
{
    $id_penjualan = Session::get('id_penjualan');
    $totalHarga = Penjualan::where('id_penjualan', $id_penjualan)->value('total_harga');
    $id_penjualan = Session::get('id_penjualan');
    return response()->json([
        'total_harga' => $totalHarga ?? 0,
        'id_penjualan' => $id_penjualan
    ]);
}

public function checkout(Request $request)
{
    $id_penjualan = Session::get('id_penjualan');
    $penjualan = Penjualan::where('id_penjualan', $id_penjualan);
    $totalHarga = $penjualan->value('total_harga');
    if ($request->bayar < $totalHarga) {
        return redirect()->back()->with('error', 'Jumlah pembayaran kurang dari total penjualan.');
    }

    $penjualan->update([
        'bayar' => $request->bayar,
        'metode' => $request->metode,
        'status' => 'Selesai'
    ]);

    $detail = Order_Jual::where('id_penjualan', $id_penjualan)->get();

    foreach($detail as $item){
        $produk = Produk::find($item->id_produk);
        $produk->stok -= $item->quantity;
        $produk->update();
    }
    
    Session::forget('id_penjualan');

    return redirect()->route('orderjual.index')->with('success', 'Pembayaran berhasil!');
}
}
 