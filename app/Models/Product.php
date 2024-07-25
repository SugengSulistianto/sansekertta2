<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'category_code',
        'name',
        'photo',
        'price',
        'weight',
        'stock',
        'description'
    ];
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    public function category(){
        return $this->belongsTo(Category::class, 'category_code');
    }

    public static function generateCode(){
        $products = self::all();
        $newNum = 0;
        foreach($products as $c){
            $currentNum = (int) substr($c->code, 3);
            if($newNum < $currentNum){
                $newNum = $currentNum;
            }
        }
        
        $newCodeNumber = $newNum + 1;
        $newCode = 'PRD' . str_pad($newCodeNumber, 2, '0', STR_PAD_LEFT);

        return $newCode;
    }

    public function carts(){
        return $this->hasMany(Cart::class, 'product_code');
    }

    public function product_photos(){
        return $this->hasMany(ProductPhoto::class, 'product_code');
    }
}
