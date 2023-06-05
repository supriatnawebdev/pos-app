<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Suplier;
use Illuminate\Http\Request;
use App\Models\PembelianDetail;

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


    // tampil data with ajax
    public function data($id)
    {
      $pembelianDetail = PembelianDetail::with('produk')->where('id_pembelian', $id)->get();

    //   return $pembelianDetail;
      return datatables()
      ->of($pembelianDetail)
      ->addIndexColumn()
      ->addColumn('nama_produk', function ($pembelianDetail){
          return $pembelianDetail->produk['nama_produk'];
      })
      ->addColumn('kode_produk', function ($pembelianDetail){
          return $pembelianDetail->produk['kode_produk'];
      })
      ->addColumn('aksi', function( $pembelianDetail) {
        return '
        <div class="btn-group ">
        <button type="button" onclick="deleteData(`'.route('pembelian_detail.destroy',  $pembelianDetail->id).'`)" class="btn btn-danger btn-sm">Delete</button>
        </div>
        ';
       })
      ->rawColumns(['aksi', ])
      ->make(true);
    }


    // store data
    public function store(Request $request){
        $produk = Produk::where('id', $request->id_produk)->first();
        // dd($produk);

        if(!$produk){
            return response()->json('data gagal disimpan atau produk tidak ada', 400);
        }

        $detailPembelian = new PembelianDetail();
        $detailPembelian->id_pembelian = $request->id_pembelian;
        $detailPembelian->id_produk = $produk->id;
        $detailPembelian->harga_beli = $produk->harga_beli;
        $detailPembelian->jumlah = 1;
        $detailPembelian->subtotal = $produk->harga_beli;

        $detailPembelian->save();

        return response()->json('data berhasil disimpan', 200);


    }

}
