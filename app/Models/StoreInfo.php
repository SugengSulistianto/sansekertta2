<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'province',
        'province_code',
        'city',
        'city_code',
        'address',
        'phone',
        'email'
    ];
}
