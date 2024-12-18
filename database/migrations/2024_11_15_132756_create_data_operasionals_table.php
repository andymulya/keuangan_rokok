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
        Schema::create('data_operasionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_laporan')->constrained('periode_laporans')->cascadeOnDelete();
            $table->string('tipe_data_operasional')->default('');
            $table->date('date');
            $table->enum('tipe', ['pemasukan', 'pengeluaran']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_operasionals');
    }
};
