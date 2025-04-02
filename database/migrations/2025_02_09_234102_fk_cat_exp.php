<?php

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
        Schema::table('pengeluaran', function(Blueprint $table){
            $table->integer('id_kategoriExp')
                  ->unsigned()
                  ->change();
            $table->foreign('id_kategoriExp')
            ->references('id_kategoriExp')
            ->on('kategori_exp')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengeluaran', function(Blueprint $table){
            $table->integer('id_kategoriExp')->change;
            $table->dropForeign('pengeluaran_id_kategoriExp_foreign');
            });
    }
};
