<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(){
        $customer = User::role('customer')->get();

        return view('admin.customer.index', compact(['customer']));
    }

    public function add(){
        return view('admin.customer.add');
    }

    public function create(Request $req){
        $customer = new User;

        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->password = Hash::make($req->password);

        $customer->save();
        $customer->assignRole('pelanggan');
        
        return redirect()->route('admin.customer.index');
    }

    public function edit(Request $req){
        $customer = User::findOrFail($req->id);

        return view('admin.customer.edit', compact(['customer']));
    }

    public function update(Request $req){
        $customer = User::findOrFail($req->id);
        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->password = Hash::make($req->password);

        $customer->save();
        
        return redirect()->route('admin.customer.index');
    }

    public function delete(Request $req){
        User::destroy($req->id);
        
        return redirect()->route('admin.customer.index');
    }
}
