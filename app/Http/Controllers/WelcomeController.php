<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\UserDetail;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\CallbackService;

class WelcomeController extends Controller
{
    public function loginadmin(){
        return view('loginadmin');
    }
    
    public function index(){
        // $categories_side = Category::latest()->take(7)->get();
        $categories_side = Category::take(9)->get();
        $categories_all= Category::all();
        $categories_card = Category::whereRaw('LENGTH(name) <= 11')->take(9)->get();
        $categories_popular = Category::whereRaw('LENGTH(name) <= 11')->take(5)->get();
        $chunked_categories = $categories_all->chunk(ceil($categories_all->count() / 4));
        $products = Product::inRandomOrder()->take(12)->get();
        $pb = Product::whereRaw('LENGTH(name) <= 20')->take(5)->get();
        $dod = Product::inRandomOrder()->take(2)->get();
        $na1 = Product::inRandomOrder()->take(4)->get();
        $na2 = Product::inRandomOrder()->take(4)->get();
        $tr1 = Product::inRandomOrder()->take(4)->get();
        $tr2 = Product::inRandomOrder()->take(4)->get();
        $bs = Product::inRandomOrder()->take(4)->get();
        $cta = Product::inRandomOrder()->take(2)->get();

        return view('welcome', compact(['pb', 'categories_popular', 'cta', 'bs', 'na1', 'na2', 'tr1', 'tr2', 'categories_side', 'categories_card', 'categories_all', 'chunked_categories', 'products', 'dod']));
    }

    public function productdetail($code){
        $categories_side = Category::take(9)->get();
        $categories_all= Category::all();
        $product = Product::findOrFail($code);
        $chunked_categories = $categories_all->chunk(ceil($categories_all->count() / 4));
        $categories_card = Category::whereRaw('LENGTH(name) <= 11')->take(9)->get();
        $categories_popular = Category::whereRaw('LENGTH(name) <= 11')->take(5)->get();
        $pb = Product::whereRaw('LENGTH(name) <= 20')->take(5)->get();
        $bs = Product::inRandomOrder()->take(4)->get();
        $na1 = Product::inRandomOrder()->take(4)->get();
        $na2 = Product::inRandomOrder()->take(4)->get();

        return view('productdetail', compact(['pb', 'categories_popular', 'categories_card', 'na1', 'na2', 'product', 'bs', 'na1', 'na2', 'chunked_categories', 'categories_all', 'categories_side']));
    }

    public function categorydetail($code){
        $categories_side = Category::take(9)->get();
        $products = Product::where('category_code', $code)->get();
        $categories_all= Category::all();
        $pb = Product::whereRaw('LENGTH(name) <= 20')->take(5)->get();
        $bs = Product::inRandomOrder()->take(4)->get();
        $chunked_categories = $categories_all->chunk(ceil($categories_all->count() / 4));
        $categories_card = Category::whereRaw('LENGTH(name) <= 11')->take(9)->get();
        $categories_popular = Category::whereRaw('LENGTH(name) <= 11')->take(5)->get();

        return view('categorydetail', compact(['pb', 'bs', 'categories_side', 'products', 'chunked_categories', 'categories_all', 'categories_card', 'categories_popular']));
    }

    public function searchproduct(Request $req){
        $categories_side = Category::take(9)->get();
        $products = Product::where('name', 'like', '%' . $req->name . '%')->get();
        $categories_all= Category::all();
        $pb = Product::whereRaw('LENGTH(name) <= 20')->take(5)->get();
        $bs = Product::inRandomOrder()->take(4)->get();
        $chunked_categories = $categories_all->chunk(ceil($categories_all->count() / 4));
        $categories_card = Category::whereRaw('LENGTH(name) <= 11')->take(9)->get();
        $categories_popular = Category::whereRaw('LENGTH(name) <= 11')->take(5)->get();

        return view('categorydetail', compact(['pb', 'bs', 'categories_side', 'products', 'chunked_categories', 'categories_all', 'categories_card', 'categories_popular']));
    }

    public function receive(){
        $callback = new CallbackService;
 
        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();
 
            if ($callback->isSuccess()) {
                $ord = Order::findOrFail($order->id);
                $ord->payment_status = "SUCCESS";                 
                $ord->save();
                
                foreach($ord->details as $detail){
                    $product = Product::find($detail->product_code);
                    $product->stock -= $detail->amount;
                    $product->save();
                }                    

                $detail = UserDetail::where('user_id', $ord->user_id)->first();
                $detail->point = intval($ord->total) / 100;
                $detail->save();
            }
 
            if ($callback->isExpire()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 'EXPIRED',
                ]);
            }
 
            if ($callback->isCancelled()) {
                Order::where('id', $order->id)->update([
                    'payment_status' => 'CANCEL',
                ]);
            }
 
            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }
}
