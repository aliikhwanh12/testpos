<?php

namespace App\Http\Controllers;
use App\Models\Kategori_Exp;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori_Exp::all()->pluck('nama_kategori', 'id_kategoriExp');
        $expense = Pengeluaran::with('kategori')->get();
        return view('pengeluaran/pengeluaran', ['expense' => $expense], compact('kategori'));
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
        $expense = Pengeluaran::create($request->all());
        if($expense){
            return redirect()->back()->with("Pengeluaran berhasil ditambahkan");
        } else{
            return redirect()->back()->with("Pengeluaran Gagal ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $expense = Pengeluaran::find($id);
        return response()->json($expense);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $expense = Pengeluaran::find($id);
        $expense->update($request->all());
        $expense->save();
                
        return redirect()->back()->with("Pengeluaran berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $expense = Pengeluaran::find($id);
        $expense->delete();
        
        return redirect()->back()->with("Pengeluaran berhasil dihapus");
    }
}
