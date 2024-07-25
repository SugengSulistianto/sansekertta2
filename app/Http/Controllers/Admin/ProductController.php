<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use File;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        return view('admin.product.index', compact(['products']));
    }

    public function add(){
        $category = Category::all();
        
        return view('admin.product.add', compact(['category']));
    }

    public function create(Request $req){
        $code = Product::generateCode();
        $product = new Product;
        $product->code = $code;
        $product->category_code = $req->category_code;
        $product->name = $req->name;
        $product->price = $req->price;
        $product->weight = $req->weight;
        $product->stock = $req->stock;
        $product->description = $req->description;

        if($req->file('photo')){
            $validatedData = $req->validate([
                'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            $foto = $req->file('photo')->getClientOriginalName();
            $path = $req->file('photo')->move('image/photo-product/' , $foto);
            $product->photo = $foto;
        }

        $product->save();
        
        return redirect()->route('admin.product.index');
    }

    public function edit(Request $req){
        $product = Product::findOrFail($req->code);
        $category = Category::all();

        return view('admin.product.edit', compact(['product', 'category']));
    }

    public function update(Request $req){
        $product = Product::findOrFail($req->code);
        $product->category_code = $req->category_code;
        $product->name = $req->name;
        $product->price = $req->price;
        $product->weight = $req->weight;
        $product->stock = $req->stock;
        $product->description = $req->description;

        if($req->file('photo')){
            if(File::exists('image/photo-product/' . $product->photo)) {
                File::delete('image/photo-product/' . $product->photo);
            }

            $validatedData = $req->validate([
                'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            $foto = $req->file('photo')->getClientOriginalName();
            $path = $req->file('photo')->move('image/photo-product/' , $foto);
            $product->photo = $foto;
        }

        $product->save();
        
        return redirect()->route('admin.product.index');
    }

    public function delete(Request $req){
        $product = Product::findOrFail($req->code);        
        if(File::exists('image/photo-product/' . $product->photo)) {
            File::delete('image/photo-product/' . $product->photo);
            Product::destroy($req->code);
        }
        
        return redirect()->route('admin.product.index');
    }
}
