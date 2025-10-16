<?php

namespace App\Models;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Jual extends Model
{
    use HasFactory;
    protected $table = 'order_jual';
    protected $guarded = [];
     
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
