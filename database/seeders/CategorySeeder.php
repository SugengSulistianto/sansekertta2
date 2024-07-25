<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
            
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Pakaian Pria', 'description' => ''],
            ['id' => 2, 'name' => 'Pakaian Wanita', 'description' => ''],
            ['id' => 3, 'name' => 'Pakaian Anak', 'description' => ''],
            ['id' => 4, 'name' => 'Sepatu Pria', 'description' => ''],
            ['id' => 5, 'name' => 'Sepatu Wanita', 'description' => ''],
            ['id' => 6, 'name' => 'Aksesoris', 'description' => ''],
            ['id' => 7, 'name' => 'Tas', 'description' => ''],
            ['id' => 8, 'name' => 'Pakaian Olahraga', 'description' => ''],
        ];

        foreach($categories as $c){
            Category::create([
                'code' => 'CAT' . $c['id'],
                'name' => $c['name'],
                'description' => ''
            ]);
        }
    }
}
