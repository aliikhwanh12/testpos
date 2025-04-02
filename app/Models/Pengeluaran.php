<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kategori_Exp;
class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori_Exp::class, 'id_kategoriExp', 'id_kategoriExp');
    }
}
