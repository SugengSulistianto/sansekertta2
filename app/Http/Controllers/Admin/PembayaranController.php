<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Jenis;
use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index(){
        $pesanan = Pesanan::all();

        return view('admin.pembayaran.index', compact(['pesanan']));
    }

    public function add(){
        $layanan = Layanan::all();
        $pelanggan = User::role('pelanggan')->get();
        $kasir = Auth::user();

        return view('admin.pesanan.transaction', compact(['layanan', 'pelanggan', 'kasir']));
    }

    private function generateKode(){
        $prefix = "BYR00";
        
        $pembayaran = Pembayaran::all();
        $lastNumber = 0;
    
        foreach ($pembayaran as $j) {
            $number = intval(substr($j->kode, strlen($prefix)));
            $lastNumber = max($lastNumber, $number);
        }
    
        $nextNumber = $lastNumber + 1;
        
        $kode = $prefix . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        return $kode;
    }

    public function edit($id){
        $kasir = User::role(['admin', 'pegawai'])->get();
        $pesanan = Pesanan::findOrFail($id);

        return view('admin.pembayaran.edit', compact(['pesanan', 'kasir']));
    }

    public function update(Request $req){
        $pesanan = Pesanan::findOrFail($req->kode);
        $pesanan->status = $req->status_pesanan;
        $pesanan->isTemp = false;
        $pesanan->kasir_id = $req->kasir_id;
        $pesanan->save();

        if($pesanan->pembayaran == NULL){
            $pembayaran = new Pembayaran;
            $pembayaran->kode = $this->generateKode();
            $pembayaran->kode_pesanan = $pesanan->kode;
            $pembayaran->tarif = $req->total;
            $pembayaran->metode = $req->metode;
            $pembayaran->save();
        }else{
            $pembayaran = Pembayaran::where('kode_pesanan', $pesanan->kode)->first();
            $pembayaran->tarif = $req->total;
            $pembayaran->metode = $req->metode;
            $pembayaran->save();
        }

        return redirect()->route('admin.pembayaran.index');
    }

    public function delete($id){
        // return $id;
        Pembayaran::destroy($id);

        return redirect()->route('admin.pembayaran.index');
    }
}
