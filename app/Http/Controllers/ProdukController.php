<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori_Produk;
use Illuminate\Http\Request
;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori_Produk::all()->pluck('nama_kategori', 'id_kategoriProduk');
        $produk = Produk::with('kategori')->get();
        return view('produk/produk', ['produk' => $produk], compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produk = Produk::create($request->all());
        if($produk){
            return redirect()->back()->with("Produk berhasil ditambahkan");
        } else{
            return redirect()->back()->with("Produk Gagal ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = Produk::find($id);
        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
        return redirect()->back()->with('success', 'Produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return redirect()->back()->with("Produk berhasil dihapus");
    }
}
