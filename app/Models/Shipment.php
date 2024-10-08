<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'order_id',
        'price',
        'courier',
        'estimate',
        'service',
        'shipment_status',
        'resi'
    ];
}
