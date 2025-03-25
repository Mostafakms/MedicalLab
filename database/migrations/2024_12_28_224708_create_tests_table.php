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
        Schema::create('tests', function (Blueprint $table) {
            $table->id(); // مفتاح رئيسي
            $table->string('name'); // اسم التحليل
            $table->string('family')->nullable(); // عائلة التحليل
            $table->decimal('price', 8, 2); // السعر
            $table->string('normal_range'); // المدى الطبيعي
            $table->string('Unit'); 
            $table->timestamps(); // created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
