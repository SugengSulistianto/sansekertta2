<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\StoreInfo;

class DashboardController extends Controller
{
    public function index(){
        $customer = User::role('customer')->get();
        $store = User::role('store')->get();
        $category = Category::all();
        $product = Product::all();
        $order = Order::all();
        
        return view('admin.index', compact(['customer', 'store', 'category', 'product', 'order']));
    }

    public function storeinfo(){
        $storeinfo = StoreInfo::find(1);
        
        return view('admin.storeinfo', compact(['storeinfo']));
    }

    public function storeinfoupdate(Request $req){
        $storeinfo = StoreInfo::find(1);

        $storeinfo->name = $req->name;
        $storeinfo->province = $req->province_name;
        $storeinfo->province_code = $req->province;
        $storeinfo->city = $req->city_name;
        $storeinfo->city_code = $req->city;
        $storeinfo->address = $req->address;
        $storeinfo->phone = $req->phone;
        $storeinfo->email = $req->email;

        $storeinfo->save();
        
        return redirect()->route('storeinfo');
    }
}
