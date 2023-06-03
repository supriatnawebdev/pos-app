<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('suplier.index');
    }

    public function data()
    {
      $suplier = Suplier::all();

      return datatables()
      ->of($suplier)
      ->addIndexColumn()
      ->addColumn('aksi', function( $suplier) {
        return '
        <div class="btn-group ">
        <button type="button" onclick="editData(`'.route('suplier.update', $suplier->id).'`)" class="btn btn-warning btn-sm">Edit</button>
        <button type="button" onclick="deleteData(`'.route('suplier.destroy',  $suplier->id).'`)" class="btn btn-danger btn-sm">Delete</button>
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




        $suplier = new Suplier();
        $suplier->nama_suplier = $request->nama_suplier;
        $suplier->telpon = $request->telpon;
        $suplier->alamat = $request->alamat;
        $suplier->save();

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
        $suplier = Suplier::find($id);
        return response()->json($suplier, 200);
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

        $suplier = Suplier::find($id)->update($request->all());
        // $suplier->update();

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
        $suplier = Suplier::find($id);
        $suplier->delete();
        return response(null, 204);
    }



}
