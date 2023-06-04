<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Suplier;
use Illuminate\Http\Request;

class PembelianDetailController extends Controller
{
    public function index(){

        $id_pembelian = session('id_pembelian');
        $produks = Produk::orderBy('nama_produk')->get();
        $suplier = Suplier::find(session('id_suplier'));

        // return session('id_suplier');

        if(!$suplier) {
            abort(404);
        }

        return view('pembelian_detail.index', compact('id_pembelian', 'produks', 'suplier'));
    }

    public function store(Request $request){
        $produk = Produk::where('id', $request->id_produk)->first();
        dd($produk);
    }
}
