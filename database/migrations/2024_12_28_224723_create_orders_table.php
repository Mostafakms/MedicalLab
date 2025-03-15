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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // مفتاح رئيسي
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade'); // علاقة بالمريض
            $table->date('order_date'); // تاريخ الطلب
            $table->decimal('total_amount', 10, 2)->default(0); // الإجمالي
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending'); // حالة الطلب
            $table->timestamps(); // created_at و updated_at
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
