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
        Schema::create('layout_bahans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instruction_id');
            $table->foreign('instruction_id')->references('id')->on('instructions')->onDelete('cascade');
            $table->string('sortorder')->nullable();
            $table->string('state')->nullable();
            $table->string('include_belakang')->nullable();
            $table->string('panjang_plano')->nullable();
            $table->string('lebar_plano')->nullable();
            $table->json('lembar_cetak')->nullable();
            // $table->string('panjang_lembar_cetak')->nullable();
            // $table->string('lebar_lembar_cetak')->nullable();
            $table->string('jenis_bahan')->nullable();
            $table->string('gramasi')->nullable();
            $table->string('one_plano')->nullable();
            $table->string('sumber_bahan')->nullable();
            $table->string('merk_bahan')->nullable();
            $table->string('supplier')->nullable();
            $table->string('jumlah_lembar_cetak')->nullable();
            $table->string('jumlah_incit')->nullable();
            $table->string('total_lembar_cetak')->nullable();
            $table->string('harga_bahan')->nullable();
            $table->string('jumlah_bahan')->nullable();
            $table->string('panjang_sisa_bahan')->nullable();
            $table->string('lebar_sisa_bahan')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->longText('dataJSON')->nullable();
            $table->string('layout_custom_file_name')->nullable();
            $table->string('layout_custom_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layout_bahans');
    }
};
