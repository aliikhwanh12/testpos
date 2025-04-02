<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori_Exp extends Model
{
    use HasFactory;
    protected $table = 'kategori_exp';
    protected $primaryKey = 'id_kategoriExp';
    protected $guarded = [];
}
