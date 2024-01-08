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
        Schema::create('file_rincian_labels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_keterangan_label_id');
            $table->foreign('form_keterangan_label_id')->references('id')->on('form_keterangan_labels')->onDelete('cascade');
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_rincian_labels');
    }
};
