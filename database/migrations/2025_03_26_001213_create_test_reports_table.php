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
        Schema::create('test_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_detail_id'); // مفتاح الربط مع تفاصيل الطلب
            $table->text('consistency');
            $table->text('mucus');
            $table->text('blood');
            $table->text('odour');
            $table->text('colour');
            $table->text('worms');
            $table->text('rbc');
            $table->text('pus_cells');
            $table->text('starch_granules');
            $table->text('fat_globules');
            $table->text('muscle_fibers');
            $table->text('vegetable_cells');
            $table->text('ova');
            $table->text('larva');
            $table->text('protozoa');
            $table->timestamps();
    
            // إنشاء علاقة مع جدول order_details
            $table->foreign('order_detail_id')->references('id')->on('order_details')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_reports');
    }
};
