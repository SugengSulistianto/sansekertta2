<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function index(){
        $sizes = Size::all();

        return view('admin.size.index', compact(['sizes']));
    }

    public function create(Request $req){
        $sizes = new Size;
        $sizes->size = $req->size;

        $sizes->save();
        
        return redirect()->route('admin.size.index');
    }

    public function delete($id){
        Size::destroy($id);

        return redirect()->route('admin.size.index');
    }
}
