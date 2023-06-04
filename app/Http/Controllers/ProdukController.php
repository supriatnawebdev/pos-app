<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use PDF;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id');
        return view('produk.index', compact('kategori'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
      $produk = Produk::leftJoin('kategoris', 'kategoris.id', 'produks.id_kategori')
                    ->select('produks.*', 'nama_kategori')
                    ->orderBy('id', 'desc')->get();

      return datatables()
      ->of($produk)
      ->addIndexColumn()
      ->addColumn('select_all', function( $produk){
        return '
        <input type="checkbox" name="id[]" value="'.$produk->id.'"/>
        ';
      })
      ->addColumn('harga_beli', function( $produk){
        return format_idr($produk->harga_beli);
      })
      ->addColumn('harga_jual', function( $produk){
        return format_idr($produk->harga_jual);
      })
      ->addColumn('aksi', function( $produk) {
        return '
        <div class="btn-group ">
        <button type="button" onclick="editData(`'.route('produk.update', $produk->id).'`)" class="btn btn-warning btn-sm">Edit</button>
        <button type="button" onclick="deleteData(`'.route('produk.destroy',  $produk->id).'`)" class="btn btn-danger btn-sm">Delete</button>
        </div>
        ';
       })
      ->rawColumns(['aksi','select_all'])
      ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $produk = new Produk();
        // $produk->nama_produk = $request->nama_produk;
        // $produk->save();

        $produk = Produk::latest()->first() ?? new Produk();
        $kode_produk = 'P'. tambah_nol_didepan((int)$produk->id +1, 6);


       $produk = new Produk();
       $produk->kode_produk = $kode_produk;
       $produk->nama_produk = $request->nama_produk;
       $produk->id_kategori = $request->id_kategori;
       $produk->merek = $request->merek;
       $produk->harga_beli = $request->harga_beli;
       $produk->harga_jual = $request->harga_jual;
       $produk->diskon = $request->diskon;
       $produk->stok = $request->stok;
       $produk->save();

        return response()->json('Data berhsil disimpn', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::find($id);
        return response()->json($produk, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->update($request->all());

        return response()->json('Data berhsil diupdate', 200);
    }



    // function delete selected
    public function deleteSelected(Request $request){
        // return $request->id;
        foreach ($request->id as $id_produk) {
            # code...
            $produk = Produk::find($id_produk);
            $produk->delete();
        }
        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return response(null, 204);
    }


    // cetak barCode
    public function cetakBarcode(Request $request){

        $no =1;
        $dataProduk = array();
        foreach ($request->id as $id) {
            # code...
            $produk = Produk::find($id);
            $dataProduk[] = $produk;

        }

        $pdf = PDF::loadView('produk.barcode', compact('dataProduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('produk.pdf');
    }



}
