<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description'
    ];
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    public function products(){
        return $this->hasMany(Product::class, 'category_code');
    }

    public static function generateCode(){
        $categories = Category::all();
        $newNum = 0;
        foreach($categories as $c){
            $currentNum = (int) substr($c->code, 3);
            if($newNum < $currentNum){
                $newNum = $currentNum;
            }
        }
        
        $newCodeNumber = $newNum + 1;
        $newCode = 'CAT' . str_pad($newCodeNumber, 2, '0', STR_PAD_LEFT);

        return $newCode;
    }
}
