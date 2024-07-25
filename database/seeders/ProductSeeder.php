<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
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
            ['id' => 1, 'name' => 'Kemeja Pria Slim Fit', 'category_code' => "CAT1", 'weight' => 1, 'stock' => 10, 'description' => 'Kemeja Pria Slim Fit dengan bahan berkualitas.', 'price' => 150000, 'photo' => 'kemeja_pria_slim_fit.jpg'],
            ['id' => 2, 'name' => 'Kaos Pria Casual', 'category_code' => "CAT1", 'weight' => 1, 'stock' => 20, 'description' => 'Kaos Pria Casual nyaman dipakai.', 'price' => 75000, 'photo' => 'kaos_pria_casual.jpg'],
            ['id' => 3, 'name' => 'Jaket Denim Pria', 'category_code' => "CAT1", 'weight' => 2, 'stock' => 15, 'description' => 'Jaket Denim Pria stylish dan hangat.', 'price' => 250000, 'photo' => 'jaket_denim_pria.jpg'],
            ['id' => 4, 'name' => 'Celana Jeans Pria', 'category_code' => "CAT1", 'weight' => 1.5, 'stock' => 25, 'description' => 'Celana Jeans Pria nyaman dipakai.', 'price' => 200000, 'photo' => 'celana_jeans_pria.jpg'],
            ['id' => 5, 'name' => 'Blazer Pria', 'category_code' => "CAT1", 'weight' => 1, 'stock' => 10, 'description' => 'Blazer Pria untuk acara formal.', 'price' => 300000, 'photo' => 'blazer_pria.jpg'],
            ['id' => 6, 'name' => 'Sweater Pria', 'category_code' => "CAT1", 'weight' => 1, 'stock' => 20, 'description' => 'Sweater Pria hangat dan nyaman.', 'price' => 175000, 'photo' => 'sweater_pria.jpg'],
            ['id' => 7, 'name' => 'Jas Pria Formal', 'category_code' => "CAT1", 'weight' => 2, 'stock' => 5, 'description' => 'Jas Pria Formal untuk acara penting.', 'price' => 500000, 'photo' => 'jas_pria_formal.jpg'],

            // Pakaian Wanita
            ['id' => 8, 'name' => 'Blouse Wanita Modern', 'category_code' => "CAT2", 'weight' => 1, 'stock' => 20, 'description' => 'Blouse Wanita dengan desain modern.', 'price' => 120000, 'photo' => 'blouse_wanita_modern.jpg'],
            ['id' => 9, 'name' => 'Dress Wanita Elegan', 'category_code' => "CAT2", 'weight' => 1, 'stock' => 10, 'description' => 'Dress Wanita untuk acara formal.', 'price' => 250000, 'photo' => 'dress_wanita_elegan.jpg'],
            ['id' => 10, 'name' => 'Cardigan Wanita', 'category_code' => "CAT2", 'weight' => 1, 'stock' => 15, 'description' => 'Cardigan Wanita nyaman dipakai.', 'price' => 100000, 'photo' => 'cardigan_wanita.jpg'],
            ['id' => 11, 'name' => 'Rok Wanita', 'category_code' => "CAT2", 'weight' => 0.5, 'stock' => 25, 'description' => 'Rok Wanita dengan desain cantik.', 'price' => 80000, 'photo' => 'rok_wanita.jpg'],
            ['id' => 12, 'name' => 'Jaket Kulit Wanita', 'category_code' => "CAT2", 'weight' => 2, 'stock' => 10, 'description' => 'Jaket Kulit Wanita stylish dan hangat.', 'price' => 350000, 'photo' => 'jaket_kulit_wanita.jpg'],
            ['id' => 13, 'name' => 'Legging Wanita', 'category_code' => "CAT2", 'weight' => 0.5, 'stock' => 30, 'description' => 'Legging Wanita nyaman untuk olahraga.', 'price' => 50000, 'photo' => 'legging_wanita.jpg'],
            ['id' => 14, 'name' => 'Kemeja Wanita', 'category_code' => "CAT2", 'weight' => 1, 'stock' => 20, 'description' => 'Kemeja Wanita formal.', 'price' => 130000, 'photo' => 'kemeja_wanita.jpg'],

            // Pakaian Anak
            ['id' => 15, 'name' => 'Kaos Anak Laki-Laki', 'category_code' => "CAT3", 'weight' => 0.5, 'stock' => 25, 'description' => 'Kaos Anak Laki-Laki dengan desain lucu.', 'price' => 50000, 'photo' => 'kaos_anak_laki.jpg'],
            ['id' => 16, 'name' => 'Gaun Anak Perempuan', 'category_code' => "CAT3", 'weight' => 0.5, 'stock' => 15, 'description' => 'Gaun Anak Perempuan dengan desain cantik.', 'price' => 75000, 'photo' => 'gaun_anak_perempuan.jpg'],
            ['id' => 17, 'name' => 'Jaket Anak', 'category_code' => "CAT3", 'weight' => 1, 'stock' => 20, 'description' => 'Jaket Anak hangat dan nyaman.', 'price' => 100000, 'photo' => 'jaket_anak.jpg'],
            ['id' => 18, 'name' => 'Setelan Anak Laki-Laki', 'category_code' => "CAT3", 'weight' => 1, 'stock' => 15, 'description' => 'Setelan Anak Laki-Laki untuk acara formal.', 'price' => 120000, 'photo' => 'setelan_anak_laki.jpg'],
            ['id' => 19, 'name' => 'Setelan Anak Perempuan', 'category_code' => "CAT3", 'weight' => 1, 'stock' => 15, 'description' => 'Setelan Anak Perempuan untuk acara formal.', 'price' => 120000, 'photo' => 'setelan_anak_perempuan.jpg'],
            ['id' => 20, 'name' => 'Celana Anak', 'category_code' => "CAT3", 'weight' => 0.5, 'stock' => 30, 'description' => 'Celana Anak nyaman dipakai.', 'price' => 60000, 'photo' => 'celana_anak.jpg'],
            ['id' => 21, 'name' => 'Piyama Anak', 'category_code' => "CAT3", 'weight' => 0.5, 'stock' => 20, 'description' => 'Piyama Anak lucu dan nyaman.', 'price' => 70000, 'photo' => 'piyama_anak.jpg'],

            // Sepatu Pria
            ['id' => 22, 'name' => 'Sneakers Pria', 'category_code' => "CAT4", 'weight' => 1, 'stock' => 20, 'description' => 'Sneakers Pria nyaman untuk sehari-hari.', 'price' => 200000, 'photo' => 'sneakers_pria.jpg'],
            ['id' => 23, 'name' => 'Sepatu Formal Pria', 'category_code' => "CAT4", 'weight' => 1, 'stock' => 15, 'description' => 'Sepatu Formal Pria untuk acara resmi.', 'price' => 300000, 'photo' => 'sepatu_formal_pria.jpg'],
            ['id' => 24, 'name' => 'Boots Pria', 'category_code' => "CAT4", 'weight' => 2, 'stock' => 10, 'description' => 'Boots Pria kuat dan tahan lama.', 'price' => 400000, 'photo' => 'boots_pria.jpg'],
            ['id' => 25, 'name' => 'Sandal Pria', 'category_code' => "CAT4", 'weight' => 0.5, 'stock' => 25, 'description' => 'Sandal Pria nyaman dipakai.', 'price' => 50000, 'photo' => 'sandal_pria.jpg'],
            ['id' => 26, 'name' => 'Sepatu Lari Pria', 'category_code' => "CAT4", 'weight' => 1, 'stock' => 20, 'description' => 'Sepatu Lari Pria ringan dan nyaman.', 'price' => 250000, 'photo' => 'sepatu_lari_pria.jpg'],
            ['id' => 27, 'name' => 'Loafers Pria', 'category_code' => "CAT4", 'weight' => 1, 'stock' => 15, 'description' => 'Loafers Pria casual.', 'price' => 200000, 'photo' => 'loafers_pria.jpg'],
            ['id' => 28, 'name' => 'Sepatu Pantofel Pria', 'category_code' => "CAT4", 'weight' => 1, 'stock' => 10, 'description' => 'Sepatu Pantofel Pria formal.', 'price' => 350000, 'photo' => 'sepatu_pantofel_pria.jpg'],

            // Sepatu Wanita
            ['id' => 29, 'name' => 'Heels Wanita', 'category_code' => "CAT5", 'weight' => 1, 'stock' => 20, 'description' => 'Heels Wanita elegan.', 'price' => 250000, 'photo' => 'heels_wanita.jpg'],
            ['id' => 30, 'name' => 'Flat Shoes Wanita', 'category_code' => "CAT5", 'weight' => 1, 'stock' => 25, 'description' => 'Flat Shoes Wanita nyaman.', 'price' => 150000, 'photo' => 'flat_shoes_wanita.jpg'],
            ['id' => 31, 'name' => 'Sneakers Wanita', 'category_code' => "CAT5", 'weight' => 1, 'stock' => 20, 'description' => 'Sneakers Wanita casual.', 'price' => 200000, 'photo' => 'sneakers_wanita.jpg'],
            ['id' => 32, 'name' => 'Sandal Wanita', 'category_code' => "CAT5", 'weight' => 0.5, 'stock' => 30, 'description' => 'Sandal Wanita nyaman dipakai.', 'price' => 100000, 'photo' => 'sandal_wanita.jpg'],
            ['id' => 33, 'name' => 'Boots Wanita', 'category_code' => "CAT5", 'weight' => 2, 'stock' => 10, 'description' => 'Boots Wanita stylish.', 'price' => 350000, 'photo' => 'boots_wanita.jpg'],
            ['id' => 34, 'name' => 'Sepatu Lari Wanita', 'category_code' => "CAT5", 'weight' => 1, 'stock' => 20, 'description' => 'Sepatu Lari Wanita ringan.', 'price' => 250000, 'photo' => 'sepatu_lari_wanita.jpg'],
            ['id' => 35, 'name' => 'Loafers Wanita', 'category_code' => "CAT5", 'weight' => 1, 'stock' => 15, 'description' => 'Loafers Wanita casual.', 'price' => 180000, 'photo' => 'loafers_wanita.jpg'],

            // Aksesoris
            ['id' => 36, 'name' => 'Topi Baseball', 'category_code' => "CAT6", 'weight' => 0.3, 'stock' => 50, 'description' => 'Topi Baseball stylish.', 'price' => 50000, 'photo' => 'topi_baseball.jpg'],
            ['id' => 37, 'name' => 'Ikat Pinggang Kulit', 'category_code' => "CAT6", 'weight' => 0.2, 'stock' => 40, 'description' => 'Ikat Pinggang Kulit elegan.', 'price' => 100000, 'photo' => 'ikat_pinggang_kulit.jpg'],
            ['id' => 38, 'name' => 'Kacamata Hitam', 'category_code' => "CAT6", 'weight' => 0.1, 'stock' => 30, 'description' => 'Kacamata Hitam trendy.', 'price' => 75000, 'photo' => 'kacamata_hitam.jpg'],
            ['id' => 39, 'name' => 'Syal Rajut', 'category_code' => "CAT6", 'weight' => 0.5, 'stock' => 25, 'description' => 'Syal Rajut hangat.', 'price' => 85000, 'photo' => 'syal_rajut.jpg'],
            ['id' => 40, 'name' => 'Jam Tangan Fashion', 'category_code' => "CAT6", 'weight' => 0.2, 'stock' => 20, 'description' => 'Jam Tangan Fashion modern.', 'price' => 150000, 'photo' => 'jam_tangan_fashion.jpg'],
            ['id' => 41, 'name' => 'Anting Emas', 'category_code' => "CAT6", 'weight' => 0.1, 'stock' => 15, 'description' => 'Anting Emas elegan.', 'price' => 250000, 'photo' => 'anting_emas.jpg'],
            ['id' => 42, 'name' => 'Gelang Kulit', 'category_code' => "CAT6", 'weight' => 0.1, 'stock' => 20, 'description' => 'Gelang Kulit trendy.', 'price' => 65000, 'photo' => 'gelang_kulit.jpg'],

            // Tas
            ['id' => 43, 'name' => 'Tas Ransel', 'category_code' => "CAT7", 'weight' => 1, 'stock' => 20, 'description' => 'Tas Ransel dengan banyak kantong.', 'price' => 200000, 'photo' => 'tas_ransel.jpg'],
            ['id' => 44, 'name' => 'Tas Selempang', 'category_code' => "CAT7", 'weight' => 0.5, 'stock' => 30, 'description' => 'Tas Selempang casual.', 'price' => 150000, 'photo' => 'tas_selempang.jpg'],
            ['id' => 45, 'name' => 'Tas Tangan', 'category_code' => "CAT7", 'weight' => 0.5, 'stock' => 25, 'description' => 'Tas Tangan elegan.', 'price' => 180000, 'photo' => 'tas_tangan.jpg'],
            ['id' => 46, 'name' => 'Tas Laptop', 'category_code' => "CAT7", 'weight' => 1.5, 'stock' => 15, 'description' => 'Tas Laptop dengan bantalan.', 'price' => 250000, 'photo' => 'tas_laptop.jpg'],
            ['id' => 47, 'name' => 'Tas Tote', 'category_code' => "CAT7", 'weight' => 0.5, 'stock' => 20, 'description' => 'Tas Tote besar.', 'price' => 120000, 'photo' => 'tas_tote.jpg'],
            ['id' => 48, 'name' => 'Tas Kulit', 'category_code' => "CAT7", 'weight' => 1, 'stock' => 10, 'description' => 'Tas Kulit elegan.', 'price' => 300000, 'photo' => 'tas_kulit.jpg'],
            ['id' => 49, 'name' => 'Tas Ransel Anak', 'category_code' => "CAT7", 'weight' => 0.5, 'stock' => 25, 'description' => 'Tas Ransel Anak lucu.', 'price' => 100000, 'photo' => 'tas_ransel_anak.jpg'],

            // Pakaian Olahraga
            ['id' => 50, 'name' => 'Kaos Olahraga Pria', 'category_code' => "CAT8", 'weight' => 0.5, 'stock' => 25, 'description' => 'Kaos Olahraga Pria nyaman.', 'price' => 85000, 'photo' => 'kaos_olahraga_pria.jpg'],
            ['id' => 51, 'name' => 'Kaos Olahraga Wanita', 'category_code' => "CAT8", 'weight' => 0.5, 'stock' => 25, 'description' => 'Kaos Olahraga Wanita stylish.', 'price' => 85000, 'photo' => 'kaos_olahraga_wanita.jpg'],
            ['id' => 52, 'name' => 'Celana Olahraga Pria', 'category_code' => "CAT8", 'weight' => 0.5, 'stock' => 20, 'description' => 'Celana Olahraga Pria ringan.', 'price' => 90000, 'photo' => 'celana_olahraga_pria.jpg'],
            ['id' => 53, 'name' => 'Celana Olahraga Wanita', 'category_code' => "CAT8", 'weight' => 0.5, 'stock' => 20, 'description' => 'Celana Olahraga Wanita nyaman.', 'price' => 90000, 'photo' => 'celana_olahraga_wanita.jpg'],
            ['id' => 54, 'name' => 'Jaket Olahraga Pria', 'category_code' => "CAT8", 'weight' => 1, 'stock' => 15, 'description' => 'Jaket Olahraga Pria hangat.', 'price' => 150000, 'photo' => 'jaket_olahraga_pria.jpg'],
            ['id' => 55, 'name' => 'Jaket Olahraga Wanita', 'category_code' => "CAT8", 'weight' => 1, 'stock' => 15, 'description' => 'Jaket Olahraga Wanita nyaman.', 'price' => 150000, 'photo' => 'jaket_olahraga_wanita.jpg'],
            ['id' => 56, 'name' => 'Sepatu Olahraga', 'category_code' => "CAT8", 'weight' => 1, 'stock' => 20, 'description' => 'Sepatu Olahraga ringan dan nyaman.', 'price' => 200000, 'photo' => 'sepatu_olahraga.jpg'],

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
