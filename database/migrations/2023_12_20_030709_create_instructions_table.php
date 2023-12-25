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
        Schema::create('instructions', function (Blueprint $table) {
            $table->id();
            $table->string('condition')->default('new');
            $table->string('spk_number');
            $table->string('spk_type');
            $table->string('taxes_type');
            $table->string('state')->default(0); // 0 = spk biasa, 1 = parent, 2 = child
            $table->string('parent')->nullable();
            $table->string('customer_name')->nullable();
            $table->boolean('spk_fsc')->default(false);
            $table->string('fsc_type')->nullable();
            $table->string('spk_number_fsc')->nullable();
            $table->date('order_date');
            $table->date('delivery_date');
            $table->json('initial_delivery_date');
            $table->boolean('foc')->default(false);
            $table->string('purchase_order');
            $table->string('order_name');
            $table->string('code_style');
            $table->integer('quantity');
            $table->integer('quantity_stock')->nullable();
            $table->string('followup');
            $table->string('price');
            $table->string('ppn');
            $table->integer('panjang_barang');
            $table->integer('lebar_barang');
            $table->string('spk_layout')->nullable();
            $table->string('spk_sample')->nullable();
            $table->string('spk_stock')->nullable();
            $table->string('year')->nullable()->default(date('Y'));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructions');
    }
};
