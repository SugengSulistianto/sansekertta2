<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'size',
    ];   

    public function products(){
        return $this->belongsToMany(Product::class, 'product_size', 'size_id', 'product_code');
    }
}
