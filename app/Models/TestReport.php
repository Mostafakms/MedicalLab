<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_detail_id',
        'consistency',
        'mucus',
        'blood',
        'odour',
        'colour',
        'worms',
        'rbc',
        'pus_cells',
        'starch_granules',
        'fat_globules',
        'muscle_fibers',
        'vegetable_cells',
        'ova',
        'larva',
        'protozoa',
    ];

    // تعريف علاقة التقرير بتفاصيل الطلب
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
