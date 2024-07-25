<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function index(){
        $store = User::role('store')->get();

        return view('admin.store.index', compact(['store']));
    }
}
