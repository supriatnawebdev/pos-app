<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index(){

        $supliers = Suplier::all();
        return view('pembelian.index', compact('supliers'));
    }


    public function create($id)
    {
        $pembelian = new Pembelian();
        $pembelian->id_suplier  = $id;
        $pembelian->total_item  = 0;
        $pembelian->total_harga = 0;
        $pembelian->diskon      = 0;
        $pembelian->bayar       = 0;
        $pembelian->save();

        session(['id_pembelian' => $pembelian->id]);
        session(['id_suplier' => $pembelian->id_suplier]);


        return redirect()->route('pembelian_detail.index');
    }
}
