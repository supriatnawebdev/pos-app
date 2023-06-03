<?php

namespace App\Http\Controllers;

use App\Models\Member;
use PDF;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index');
    }

    public function data()
    {
      $member = Member::all();

      return datatables()
      ->of($member)
      ->addIndexColumn()
      ->addColumn('select_all', function( $member){
        return '
        <input type="checkbox" name="id[]" value="'.$member->id.'"/>
        ';
      })
      ->addColumn('kode_member', function ($member){
        return '<span class="label label-success">'.$member->kode_member.'</span>';
      })
      ->addColumn('aksi', function( $member) {
        return '
        <div class="btn-group ">
        <button type="button" onclick="editData(`'.route('member.update', $member->id).'`)" class="btn btn-warning btn-sm">Edit</button>
        <button type="button" onclick="deleteData(`'.route('member.destroy',  $member->id).'`)" class="btn btn-danger btn-sm">Delete</button>
        </div>
        ';
       })
      ->rawColumns(['aksi','kode_member', 'select_all'])
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

        $member = Member::latest()->first() ?? new Member();
         $kode_member= (int) $member->kode_member + 1;



        $member = new Member();
        $member->kode_member = tambah_nol_didepan($kode_member, 5);
        $member->nama_member = $request->nama_member;
        $member->telpon = $request->telpon;
        $member->alamat = $request->alamat;
        $member->save();

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
        $member = Member::find($id);
        return response()->json($member, 200);
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

        $member = Member::find($id)->update($request->all());
        // $member->update();

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
        $member = Member::find($id);
        $member->delete();
        return response(null, 204);
    }


    // cetak member
    public function cetakMember(Request $request){

        $no =1;
        $dataMember = collect(array());
        foreach ($request->id as $id) {
            # code...
            $member = Member::find($id);
            $dataMember[] = $member;

        }

        $dataMember = $dataMember->chunk(2);

        $pdf = PDF::loadView('member.cetak', compact('dataMember', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('member.pdf');

    }
}
