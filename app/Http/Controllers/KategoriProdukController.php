<?php

namespace App\Http\Controllers;

use App\Models\Kategori_Produk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catprod = Kategori_Produk::paginate(10);
        return view('produk/kategoriProduk', ['kategori_produk' => $catprod]);
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
        $kategori_produk = new Kategori_Produk();
        $kategori_produk->nama_kategori = $request->nama_kategori;
        $kategori_produk->save();

        if($kategori_produk){
            return redirect()->back()->with("Kategori produk berhasil ditambahkan");
        } else{
            return redirect()->back()->with("Kategori produk Gagal ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori_Produk $kategori_Produk, $id)
    {
        $kategori_produk = Kategori_Produk::find($id);
        return response()->json($kategori_produk);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori_Produk $kategori_Produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$kategori_Produk->update($request->all());
        $kategori_produk = Kategori_Produk::find($id);
        $kategori_produk->nama_kategori = $request->nama_kategori;
        $kategori_produk->save();
        
        return redirect()->back()->with("Kategori produk berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori_Produk $kategori_Produk, $id)
    {
        $kategori_produk = Kategori_Produk::find($id);
        $kategori_produk->delete();

        return redirect()->back()->with("Kategori produk berhasil dihapus");
    }
}
