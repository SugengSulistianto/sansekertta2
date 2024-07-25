<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jenis;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index(){
        $layanan = Layanan::all();

        return view('admin.layanan.index', compact(['layanan']));
    }

    public function add(){
        $prefix = "LYN00";
        
        $layanan = Layanan::all();
        $jenis = Jenis::all();
        
        // Mendapatkan nomor urut terakhir
        $lastNumber = 0;
    
        foreach ($layanan as $j) {
            $number = intval(substr($j->kode, strlen($prefix)));
            $lastNumber = max($lastNumber, $number);
        }
    
        // Menentukan nomor urut berikutnya
        $nextNumber = $lastNumber + 1;
        
        // Membuat kode dengan nomor urut baru
        $kode = $prefix . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

        return view('admin.layanan.add', compact(['kode', 'jenis']));
    }

    public function create(Request $req){
        $layanan = new Layanan;

        $layanan->kode = $req->kode;
        $layanan->kode_jenis = $req->kode_jenis;
        $layanan->estimasi = $req->estimasi;
        $layanan->nama = $req->nama;
        $layanan->harga = $req->harga;

        $layanan->save();

        return redirect()->route('admin.layanan.index');
    }

    public function edit($id){
        $layanan = Layanan::findOrFail($id);
        $jenis = Jenis::all();

        return view('admin.layanan.edit', compact(['layanan', 'jenis']));
    }

    public function update(Request $req){
        $layanan = Layanan::findOrFail($req->kode);

        $layanan->kode = $req->kode;
        $layanan->kode_jenis = $req->kode;
        $layanan->estimasi = $req->estimasi;
        $layanan->nama = $req->nama;
        $layanan->harga = $req->harga;

        $layanan->save();

        return redirect()->route('admin.layanan.index');
    }

    public function delete($id){
        Layanan::destroy($id);

        return redirect()->route('admin.layanan.index');
    }
}
