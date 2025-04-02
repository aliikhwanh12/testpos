<?php

use App\Models\Kategori_Produk;
use App\Models\Produk;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produk', function(Blueprint $table){
        $table->integer('id_kategori')
              ->unsigned()
              ->change();
        $table->foreign('id_kategori')
        ->references('id_kategoriProduk')
        ->on('kategori_produk')
        ->onDelete('restrict')
        ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function(Blueprint $table){
            $table->integer('id_kategori')->change;
            $table->dropForeign('produk_id_kategori_foreign');
            });
    }
};
