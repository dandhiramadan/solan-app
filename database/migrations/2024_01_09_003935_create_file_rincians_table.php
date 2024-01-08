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
        Schema::create('file_rincians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_keterangan_id');
            $table->foreign('form_keterangan_id')->references('id')->on('form_keterangans')->onDelete('cascade');
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_rincians');
    }
};
