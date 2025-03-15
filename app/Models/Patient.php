<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'gender', 'dob', 'phone', 'address'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
}
