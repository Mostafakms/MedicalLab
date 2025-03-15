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
        Schema::create('patients', function (Blueprint $table) {
            $table->id(); // مفتاح رئيسي
            $table->string('name'); // اسم المريض
            $table->enum('gender', ['male', 'female']); // النوع
            $table->date('dob'); // تاريخ الميلاد
            $table->string('phone')->unique(); // رقم الهاتف
            $table->text('address')->nullable(); // العنوان
            $table->timestamps(); // created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
