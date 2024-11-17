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
        Schema::create('pembagian_labas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_laporan')->constrained('periode_laporans')->cascadeOnDelete();
            $table->string('nama_penanam_saham');
            $table->string('modal');
            $table->decimal('presentase', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembagian_labas');
    }
};
