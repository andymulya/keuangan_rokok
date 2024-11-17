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
        Schema::create('data_gaji_karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_laporan')->constrained('periode_laporans')->cascadeOnDelete();
            $table->date('date');
            $table->string('keterangan');
            $table->bigInteger('kredit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_gaji_karyawans');
    }
};
