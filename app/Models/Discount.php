<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'order_id',
        'discount',
        'discount_origin',
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
