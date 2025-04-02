<?php

namespace App\Models;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order_Beli extends Model
{
    use HasFactory;
    protected $table = 'order_beli';
    protected $primaryKey = 'id_orderBeli';
    protected $guarded = [];
     
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
