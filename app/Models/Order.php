<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'status',
        'total',
        'isVerified',
        'payment_status',
        'snap_token'
    ];

    public $incrementing = false;

    public static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function details(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shipment(){
        return $this->hasOne(Shipment::class, 'order_id', 'id');
    }

    public function discounts(){
        return $this->hasMany(Discount::class, 'order_id');
    }
}
