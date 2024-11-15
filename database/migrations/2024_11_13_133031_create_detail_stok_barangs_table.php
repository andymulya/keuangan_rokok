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
        Schema::create('detail_stok_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('stok_name');
            $table->foreignId('data_pembelian_barang_id')->constrained();
            $table->string('jumlah');
            $table->bigInteger('harga_satuan');
            $table->bigInteger('harga_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_stok_barangs');
    }
};
