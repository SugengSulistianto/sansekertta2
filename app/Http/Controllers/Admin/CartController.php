<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::all();

        return view('admin.cart.index', compact(['cart']));
    }

    public function detail($id){
        $cart = Cart::findOrFail($id);

        return view('admin.cart.detail', compact(['cart']));
    }

    public function verif(Request $req){
        
    }

    public function delete($id){
        $cart = Cart::findOrFail($id);
        if($cart){
            Cart::destroy($id);
        }
        
        return redirect()->route('admin.cart.index');
    }
}
