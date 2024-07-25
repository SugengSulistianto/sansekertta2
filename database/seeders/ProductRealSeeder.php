<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductRealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            // Pakaian Pria
            ['id' => 1, 'name' => 'Kaos Bleach Black', 'category_code' => "CAT1", 'weight' => 1, 'stock' => 10, 'description' => 'Kaos Pria Casual nyaman dipakai', 'price' => 150000, 'photo' => 'kaos_bleach_black_front.jpg'],
            ['id' => 2, 'name' => 'Kaos Bleach White', 'category_code' => "CAT1", 'weight' => 1, 'stock' => 20, 'description' => 'Kaos Pria Casual nyaman dipakai.', 'price' => 75000, 'photo' => 'kaos_bleach_white_front.jpg'],
            ['id' => 3, 'name' => 'Kaos Bleachvoid Sanekertta', 'category_code' => "CAT1", 'weight' => 1, 'stock' => 15, 'description' => 'Kaos Pria Casual nyaman dipakai.', 'price' => 250000, 'photo' => 'kaos_bleachvoid_sanekertta_front.jpg'],
            ['id' => 4, 'name' => 'Kaos Sansekertta Black Model 1', 'category_code' => "CAT1", 'weight' => 1, 'stock' => 25, 'description' => 'Kaos Pria Casual nyaman dipakai', 'price' => 200000, 'photo' => 'kaos_sansekertta_black_model_1.jpg'],
            ['id' => 5, 'name' => 'Kaos Sansekertta Black Model 2', 'category_code' => "CAT1", 'weight' => 1, 'stock' => 10, 'description' => 'Kaos Pria Casual nyaman dipakai', 'price' => 300000, 'photo' => 'kaos_sansekertta_black_model_2.jpg'],
            ['id' => 6, 'name' => 'Kaos Sansekertta mmi Blue', 'category_code' => "CAT1", 'weight' => 1, 'stock' => 20, 'description' => 'Kaos Pria Casual nyaman dipakai', 'price' => 175000, 'photo' => 'kaos_sansekertta_mmi_blue_front.jpg'],

            // Pakaian Wanita
            ['id' => 8, 'name' => 'Bantal Leher Black', 'category_code' => "CAT6", 'weight' => 1, 'stock' => 20, 'description' => 'Blouse Wanita dengan desain modern.', 'price' => 120000, 'photo' => 'bantal_leher_black.jpg'],
            ['id' => 9, 'name' => 'Bantal Leher Grey', 'category_code' => "CAT6", 'weight' => 1, 'stock' => 10, 'description' => 'Dress Wanita untuk acara formal.', 'price' => 250000, 'photo' => 'bantal_leher_grey.jpg'],
            ['id' => 10, 'name' => 'Bantal Leher Yellow', 'category_code' => "CAT6", 'weight' => 1, 'stock' => 15, 'description' => 'Cardigan Wanita nyaman dipakai.', 'price' => 100000, 'photo' => 'bantal_leher_yellow.jpg'],
            ['id' => 11, 'name' => 'Asbak Sansekertta', 'category_code' => "CAT6", 'weight' => 0.5, 'stock' => 25, 'description' => 'Rok Wanita dengan desain cantik.', 'price' => 80000, 'photo' => 'asbak_main.jpg'],

        ];

        foreach ($products as $p) {
            Product::create([
                'code' => 'PRD' . $p['id'],
                'category_code' => $p['category_code'],
                'name' => $p['name'],
                'photo' => $p['photo'],
                'price' => $p['price'],
                'weight' => $p['weight'],
                'stock' => $p['stock'],
                'description' => $p['description']
            ]);
        }
    }
}
