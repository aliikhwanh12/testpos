<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi_Jual extends Model
{
    protected $table = 'transaksi__juals';
    protected $fillable = ['id_jual','id_user','total_harga','bayar','kembalian','metode'];
}
