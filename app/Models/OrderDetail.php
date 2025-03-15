<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'test_id',
        'result'
    ];


     // علاقة "تفاصيل طلب تنتمي إلى طلب واحد"

     public function order()
     {
         return $this->belongsTo(Order::class);
     }
 
     // علاقة "تفاصيل طلب تنتمي إلى تحليل واحد"
     public function test()
     {
         return $this->belongsTo(Test::class);
     }
}
