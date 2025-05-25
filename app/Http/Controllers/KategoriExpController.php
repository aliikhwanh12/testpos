<?php

namespace App\Http\Controllers;

use App\Models\Kategori_Exp;
use Illuminate\Http\Request;

class KategoriExpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catexp = Kategori_Exp::paginate(10);
        return view('pengeluaran/kategoriExpense', ['kategori_exp' => $catexp]);
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
        $kategori_exp = new Kategori_Exp();
        $kategori_exp->nama_kategori = $request->nama_kategori;
        $kategori_exp->save();

        if($kategori_exp){
            return redirect()->back()->with("Kategori produk berhasil ditambahkan");
        } else{
            return redirect()->back()->with("Kategori produk Gagal ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori_Exp $kategori_Exp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori_Exp $kategori_Exp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$kategori_Produk->update($request->all());
        $kategori_exp = Kategori_Exp::find($id);
        $kategori_exp->nama_kategori = $request->nama_kategori;
        $kategori_exp->save();
        
        return redirect()->back()->with("Kategori produk berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori_Exp $Kategori_Exp, $id)
    {
        $kategori_exp = Kategori_Exp::find($id);
        $kategori_exp->delete();

        return redirect()->back()->with("Kategori produk berhasil dihapus");
    }
}
