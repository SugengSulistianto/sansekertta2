<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Jenis;
use App\Models\Layanan;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index(){
        $pesanan = Pesanan::all();

        return view('admin.pesanan.index', compact(['pesanan']));
    }

    public function add(){
        $layanan = Layanan::all();
        $pelanggan = User::role('pelanggan')->get();
        $kasir = Auth::user();

        return view('admin.pesanan.transaction', compact(['layanan', 'pelanggan', 'kasir']));
    }

    private function generateKode(){
        $prefix = "PSN00";
        
        $pesanan = Pesanan::all();
        $lastNumber = 0;
    
        foreach ($pesanan as $j) {
            $number = intval(substr($j->kode, strlen($prefix)));
            $lastNumber = max($lastNumber, $number);
        }
    
        $nextNumber = $lastNumber + 1;
        
        $kode = $prefix . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        return $kode;
    }

    public function create(Request $req){
        $pesanan = new Pesanan;

        $total = 0;
        foreach($req->kode_layanan as $index => $l){
            $total += doubleval($req->subtotal[$index]);
        }

        $pesanan->kode = $this->generateKode();
        $pesanan->kasir_id = $req->kasir_id;
        $pesanan->pelanggan_id = $req->pelanggan_id;
        $pesanan->total = $total;
        $pesanan->status = 'proses';
        $pesanan->save();

        foreach($req->kode_layanan as $index => $l){
            $pesanan->layanan()->attach($l, ['jumlah' => $req->jumlah[$index], 'subtotal' => $req->subtotal[$index]]);
        }

        return redirect()->route('admin.pesanan.index');
    }

    public function view($id){
        $pesanan = Pesanan::findOrFail($id);
        $kasir = User::role(['admin', 'pegawai'])->get();

        return view('admin.pesanan.view', compact(['pesanan', 'kasir']));
    }

    public function edit($id){
        $layanan = Layanan::all();
        $pelanggan = User::role('pelanggan')->get();
        $kasir = User::role(['admin', 'pegawai'])->get();
        $pesanan = Pesanan::findOrFail($id);

        return view('admin.pesanan.edit', compact(['pesanan', 'layanan', 'pelanggan', 'kasir']));
    }

    public function update(Request $req){
        $pesanan = Pesanan::findOrFail($req->kode);
        $pesanan->status = $req->status_pesanan;
        $pesanan->isTemp = false;
        $pesanan->save();
        // return $req;
        foreach($req->kode_layanan as $index => $l){
            $pesanan->layanan()->updateExistingPivot($l, ['jumlah' => $req->jumlah[$index], 'subtotal' => $req->subtotal[$index]]);
        }

        return redirect()->route('admin.pesanan.index');
    }

    public function delete($id){
        Pesanan::destroy($id);

        return redirect()->route('admin.pesanan.index');
    }
}
