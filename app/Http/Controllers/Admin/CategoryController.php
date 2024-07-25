<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();

        return view('admin.category.index', compact(['category']));
    }

    public function add(){
        $code = Category::generateCode();
        
        return view('admin.category.add', compact(['code']));
    }

    public function create(Request $req){
        $category = new Category;
        $category->code = $req->code;
        $category->name = $req->name;
        $category->description = $req->description;

        $category->save();
        
        return redirect()->route('admin.category.index');
    }

    public function edit(Request $req){
        $category = Category::findOrFail($req->code);

        return view('admin.category.edit', compact(['category']));
    }

    public function update(Request $req){
        $category = Category::findOrFail($req->code);
        $category->name = $req->name;
        $category->description = $req->description;

        $category->save();
        
        return redirect()->route('admin.category.index');
    }

    public function delete(Request $req){
        Category::destroy($req->code);
        
        return redirect()->route('admin.category.index');
    }
}
