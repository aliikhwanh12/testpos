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
        Schema::create('order_beli', function (Blueprint $table) {
            $table->increments('id_orderBeli');
            $table->integer('id_pembelian');
            $table->char('id_produk', length: 13);
            $table->integer('quantity');
            $table->integer('subtotal');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_beli');
    }
};
