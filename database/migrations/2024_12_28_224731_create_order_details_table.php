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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('test_id');
            $table->text('result')->nullable(); // Column to store test results
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('order_id')
                  ->references('id')->on('orders')
                  ->onDelete('cascade');

            $table->foreign('test_id')
                  ->references('id')->on('tests')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
