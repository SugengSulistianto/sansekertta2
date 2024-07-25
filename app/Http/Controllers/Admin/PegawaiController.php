<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index(){
        $pegawai = User::role('pegawai')->get();

        return view('admin.pegawai.index', compact(['pegawai']));
    }

    public function add(){
        return view('admin.pegawai.add');
    }

    public function create(Request $req){
        $pegawai = new User;

        $pegawai->name = $req->name;
        $pegawai->email = $req->email;
        $pegawai->password = Hash::make($req->password);

        $pegawai->save();
        $pegawai->assignRole('pegawai');
        
        return redirect()->route('admin.pegawai.index');
    }

    public function edit(Request $req){
        $pegawai = User::findOrFail($req->id);

        return view('admin.pegawai.edit', compact(['pegawai']));
    }

    public function update(Request $req){
        $pegawai = User::findOrFail($req->id);
        $pegawai->name = $req->name;
        $pegawai->email = $req->email;
        $pegawai->password = Hash::make($req->password);

        $pegawai->save();
        
        return redirect()->route('admin.pegawai.index');
    }

    public function delete(Request $req){
        User::destroy($req->id);
        
        return redirect()->route('admin.pegawai.index');
    }
}
