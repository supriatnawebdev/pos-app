<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
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
      ->addColumn('aksi', function( $produk) {
        return '
        <div class="btn-group ">                      
        <button onclick="editData(`'.route('produk.update', $produk->id).'`)" class="btn btn-warning btn-sm">Edit</button>
        <button onclick="deleteData(`'.route('produk.destroy',  $produk->id).'`)" class="btn btn-danger btn-sm">Delete</button>
        </div>
        ';
       })
      ->rawColumns(['aksi'])
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

        $produk = Produk::latest()->first();
        if($produk){

            $request['kode_produk'] = 'P'. tambah_nol_didepan((int)$produk->id+1, 7);
        } else {
            
            $request['kode_produk'] = 'P'. tambah_nol_didepan((int)1, 7);
        }
        $produk = Produk::create($request->all());

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
        $produk->nama_produk = $request->nama_produk;
        $produk->update();

        return response()->json('Data berhsil diupdate', 200);
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
}
