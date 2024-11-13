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
        Schema::create('rekap_materials', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('tipe_material');
            $table->decimal('persediaan', 10, 2)->default(0);
            $table->decimal('pemakaian', 10, 2)->default(0);
            $table->decimal('sisa', 10, 2)->default(0);
            $table->bigInteger('harga_satuan')->default(0);
            $table->bigInteger('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_materials');
    }
};
