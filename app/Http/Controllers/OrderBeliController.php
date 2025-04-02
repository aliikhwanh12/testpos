<?php

namespace App\Http\Controllers;

use App\Models\Order_Beli;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek apakah sesi id_pembelian sudah ada
        if (!Session::has('id_pembelian')) {
            // Jika tidak ada, buat transaksi baru
            $pembelian = Pembelian::create([
                'id_user' => Auth::id(),
                'total_item' => 0,
                'total_harga' => 0,
                'bayar' => 0,
                'metode' => 'cash', // Akan diisi saat checkout
                'status' => 'Pending'
            ]);
    
            // Simpan id_pembelian ke session
            Session::put('id_pembelian', $pembelian->id_pembelian);
        } else {
            // Jika sudah ada, ambil dari database
            $pembelian = Pembelian::where('id_pembelian', Session::get('id_pembelian'))->firstOrFail();
        }
    
        // Ambil data order yang sudah ditambahkan ke transaksi ini
        $orders = Order_Beli::with('produk')->where('id_pembelian', $pembelian->id_pembelian)->get();
        $produk = Produk::paginate(10);
        return view('pembelian.pembelian', compact('pembelian', 'orders', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function data()
    {
    $id_pembelian = Session::get('id_pembelian'); // Ambil ID transaksi dari session
    $orders = Order_Beli::with('produk')->where('id_pembelian', $id_pembelian)->get();

    return DataTables::of($orders)->addIndexColumn()
        ->addColumn('produk.nama', function ($orders) {
            return $orders->produk->nama ?? '-';
        })
        ->addColumn('produk.stok', function ($orders) {
            return $orders->produk->stok ?? '-';
        })
        ->addColumn('produk.harga_beli', function ($orders) {
            return 'Rp ' . number_format($orders->produk->harga_beli, 0, ',', '.');
        })
        ->addColumn('quantity', function ($orders) {
            return '<input type="number" class="quantity form-control input-sm" data-id="' . $orders->id_orderBeli . '" value="' . $orders->quantity . '" min="1">';
        })
        ->addColumn('subtotal', function ($orders) {
            return 'Rp ' . number_format($orders->subtotal, 0, ',', '.');
        })
        ->addColumn('aksi', function ($orders) {
            return '<button type="button" class="bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle hapus-barang" data-bs-toggle="modal" data-id="' . $orders->id_orderBeli . '"><iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon></button>';
        })
        ->rawColumns(['quantity', 'aksi'])
        ->make(true);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $id_pembelian = Session::get('id_pembelian');
    // Cek apakah produk dengan ID tersebut ada di database
    $produk = Produk::find($request->id_produk);
    if (!$produk) {
        return response()->json(['success' => false]);
    }

    // Cek apakah produk sudah ada dalam order
    $existingOrder = Order_Beli::where('id_pembelian', $id_pembelian)
                                   ->where('id_produk', $request->id_produk)
                                   ->first();

    if ($existingOrder) {
        // Jika sudah ada, tambahkan quantity
        $existingOrder->quantity += 1;
        $existingOrder->subtotal = $produk->harga_beli * $existingOrder->quantity;
        $existingOrder->save();
    } else {
        // Jika belum ada, tambahkan sebagai order baru dengan quantity = 1
        Order_Beli::create([
            'id_pembelian' => $id_pembelian,
            'id_produk' => $request->id_produk,
            'quantity' => 1,
            'subtotal' => $produk->harga_beli,
        ]);
    }
    $pembelian = Pembelian::find($id_pembelian);
    if ($pembelian) {
        // Hitung ulang total harga & total item dalam transaksi
        $total_harga = Order_Beli::where('id_pembelian', $id_pembelian)->sum('subtotal');
        $total_item = Order_Beli::where('id_pembelian', $id_pembelian)->sum('quantity');

        $pembelian->total_harga = $total_harga;
        $pembelian->total_item = $total_item;
        $pembelian->save();
    }
    return response()->json([
        'success' => true,
        'message' => 'Produk berhasil ditambahkan'
    ]);
}


    

    /**
     * Display the specified resource.
     */
    public function show(Order_Beli $order_Beli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order_Beli $order_Beli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order_Beli $order_Beli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy(Order_Beli $order_Beli)
     {
         //
     }


    public function deleteAll(Request $request)
    {
        $id_pembelian = Session::get('id_pembelian'); // Ambil ID pembelian dari session
    
        // Hapus semua order beli berdasarkan id_pembelian
        Order_Beli::where('id_pembelian', $id_pembelian)->delete();
    
        // Set ulang total harga & total item di tabel pembelian
        $pembelian = Pembelian::find($id_pembelian);
        if ($pembelian) {
            $pembelian->total_harga = 0;
            $pembelian->total_item = 0;
            $pembelian->save();
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Semua item dalam transaksi telah dihapus'
        ]);
    }

    public function updateQuantity(Request $request)
{
    $order = Order_Beli::findOrFail($request->id_orderbeli);
    $pembelian = Pembelian::findOrFail($order->id_pembelian);
 
    // Update quantity dan subtotal
    $order->quantity = $request->quantity;
    $order->subtotal = $order->produk->harga_beli * $request->quantity;
    $order->save();

    // Update total harga transaksi
    $pembelian->total_harga = Order_Beli::where('id_pembelian', $pembelian->id_pembelian)->sum('subtotal');
    $pembelian->total_item = Order_Beli::where('id_pembelian', $pembelian->id_pembelian)->sum('quantity');
    $pembelian->save();

    return response()->json([
        'success' => true,
        'message' => 'Produk berhasil ditambahkan'
    ]);
}

public function deleteItem(Request $request)
{
    $order = Order_Beli::findOrFail($request->id_orderbeli);
    $pembelian = Pembelian::findOrFail($order->id_pembelian);

    // Hapus item
    $order->delete();

    // Update total harga setelah item dihapus
    $pembelian->total_harga = Order_Beli::where('id_pembelian', $pembelian->id_pembelian)->sum('subtotal');
    $pembelian->total_item = Order_Beli::where('id_pembelian', $pembelian->id_pembelian)->sum('quantity');
    $pembelian->save();

    return response()->json([
        'success' => true,
        'message' => 'Produk berhasil dihapus'
    ]);
}

public function getTotalHarga()
{
    $id_pembelian = Session::get('id_pembelian');
    $totalHarga = Pembelian::where('id_pembelian', $id_pembelian)->value('total_harga');
    $id_pembelian = Session::get('id_pembelian');
    return response()->json([
        'total_harga' => $totalHarga ?? 0,
        'id_pembelian' => $id_pembelian
    ]);
}

public function checkout(Request $request)
{
    $id_pembelian = Session::get('id_pembelian');
    $pembelian = Pembelian::where('id_pembelian', $id_pembelian);
    $totalHarga = $pembelian->value('total_harga');
    if ($request->bayar < $totalHarga) {
        return redirect()->back()->with('error', 'Jumlah pembayaran kurang dari total pembelian.');
    }

    $pembelian->update([
        'bayar' => $request->bayar,
        'metode' => $request->metode,
        'status' => 'Selesai'
    ]);

    $detail = Order_Beli::where('id_pembelian', $id_pembelian)->get();

    foreach($detail as $item){
        $produk = Produk::find($item->id_produk);
        $produk->stok += $item->quantity;
        $produk->update();
    }

    Session::forget('id_pembelian');

    return redirect()->route('orderbeli.index')->with('success', 'Pembayaran berhasil!');
}
}
