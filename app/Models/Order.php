<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'order_date', 'total_amount'
    ];

     // علاقة "طلب واحد إلى مريض واحد"
     public function patient()
     {
         return $this->belongsTo(Patient::class);
     }
 
     // علاقة "طلب واحد إلى عدة تفاصيل طلب"
     public function orderDetails()
     {
         return $this->hasMany(OrderDetail::class);
     }
}
