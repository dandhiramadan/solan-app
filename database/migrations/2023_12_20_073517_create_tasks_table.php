<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_status')->default('Running');
            $table->unsignedBigInteger('instruction_id')->nullable();
            $table->foreign('instruction_id')->references('id')->on('instructions')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('type')->nullable();
            $table->string('text');
            $table->string('state_text')->nullable();
            $table->integer('target_lembar_cetak')->nullable();
            $table->integer('jumlah_lembar_cetak')->nullable();
            $table->integer('initial_duration')->nullable();
            $table->integer('duration');
            $table->float('progress');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('finish_date')->nullable();
            $table->dateTime('user_start_date')->nullable();
            $table->integer('parent')->nullable();
            $table->integer('sortorder')->default(0);
            $table->integer('priority')->default(1);
            $table->string('readonly')->nullable();
            $table->string('schedule_status')->nullable()->default('Schedule Not Set'); //On Schedule, Late Delivery, Late Schedule, On Track
            $table->string('status')->nullable(); //Pending Approved, Process, Complete
            $table->string('pekerjaan')->nullable();
            $table->string('state')->default('Not Running'); //Not Running, Running, Pause, Complete
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
