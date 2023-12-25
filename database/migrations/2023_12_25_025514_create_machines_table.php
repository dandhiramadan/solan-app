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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->float('panjang_area_cetak_minimal')->nullable();
            $table->float('lebar_area_cetak_minimal')->nullable();
            $table->float('panjang_area_cetak_maximal')->nullable();
            $table->float('lebar_area_cetak_maximal')->nullable();
            $table->float('panjang_bahan_maximal')->nullable();
            $table->float('lebar_bahan_maximal')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
