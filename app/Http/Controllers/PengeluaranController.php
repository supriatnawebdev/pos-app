<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengeluaran.index');
    }

    public function data()
    {
      $pengeluaran = Pengeluaran::all();

      return datatables()
      ->of($pengeluaran)
      ->addIndexColumn()
      ->addColumn('created_at', function( $pengeluaran) {
        return tgl_indonesia($pengeluaran->created_at);
       })
      ->addColumn('nominal', function( $pengeluaran) {
        return format_idr($pengeluaran->nominal);
       })
      ->addColumn('aksi', function( $pengeluaran) {
        return '
        <div class="btn-group ">
        <button type="button" onclick="editData(`'.route('pengeluaran.update', $pengeluaran->id).'`)" class="btn btn-warning btn-sm">Edit</button>
        <button type="button" onclick="deleteData(`'.route('pengeluaran.destroy',  $pengeluaran->id).'`)" class="btn btn-danger btn-sm">Delete</button>
        </div>
        ';
       })
      ->rawColumns(['aksi', 'created_at', 'nominal'])
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




        $pengeluaran = new pengeluaran();

        $pengeluaran->deskripsi = $request->deskripsi;
        $pengeluaran->nominal = $request->nominal;
        $pengeluaran->save();

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
        $pengeluaran = Pengeluaran::find($id);
        return response()->json($pengeluaran, 200);
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

        $pengeluaran = Pengeluaran::find($id)->update($request->all());
        // $pengeluaran->update();

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
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
        return response(null, 204);
    }



}
