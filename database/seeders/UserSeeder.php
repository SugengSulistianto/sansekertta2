<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\StoreInfo;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.id',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        UserDetail::create([
            'id' => 1,
            'user_id' => $admin->id,
            'photo' => '',
            'province' => 'Yogyakarta',
            'city' => 'Sleman',
            'phone' => '081211111',
            'postal_code' => 121212,
            'detail_address' => 'Sleman',
            'gender' => 'man'
        ]);
        
        $customer = User::create([
            'name' => 'Pelanggan Satu',
            'email' => 'pelanggan1@mail.id',
            'password' => bcrypt('12345678'),
        ]);

        $customer->assignRole('customer');

        UserDetail::create([
            'id' => 2,
            'user_id' => $customer->id,
            'photo' => '',
            'province' => 'Yogyakarta',
            'city' => 'Sleman',
            'phone' => '081211113',
            'postal_code' => 121214,
            'detail_address' => 'Sleman',
            'gender' => 'man',
            'point' => 10000
        ]);

        StoreInfo::create([
            'id' => 1,
            'name' => 'Sansekertta Store',
            'address' => 'Jakarta Pusat',
            'phone' => '(021) 8888888',
            'email' => 'admin@sansekertta.com'
        ]);
    }
}
