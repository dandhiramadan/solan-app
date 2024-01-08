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
        Schema::create('form_keterangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instruction_id');
            $table->foreign('instruction_id')->references('id')->on('instructions')->onDelete('cascade');
            $table->integer('sortorder');
            $table->string('state_plate')->nullable();
            $table->integer('jumlah_plate')->nullable();
            $table->string('ukuran_plate')->nullable();
            $table->string('state_pisau')->nullable();
            $table->integer('jumlah_pisau')->nullable();
            $table->string('state_screen')->nullable();
            $table->integer('jumlah_screen')->nullable();
            $table->string('ukuran_screen')->nullable();
            $table->string('jenis_matress')->nullable();
            $table->string('state_matress')->nullable();
            $table->string('jumlah_matress')->nullable();
            $table->string('state_foil')->nullable();
            $table->string('jumlah_foil')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_keterangans');
    }
};
