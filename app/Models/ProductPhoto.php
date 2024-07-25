<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'product_code',
        'photo_1',
        'photo_2',
        'photo_3',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_code');
    }
}
