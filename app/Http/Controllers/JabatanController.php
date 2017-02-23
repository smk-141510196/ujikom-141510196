<?php

namespace App\Http\Controllers;

use Request;
use App\JabatanModel;
use Validator;
use Input;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jabatan=JabatanModel::all();
        return view('Jabatan.index',compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('Jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules=[
                'kode_jabatan'=>'required|unique:jabatans,kode_jabatan',
                'nama_jabatan'=>'required',
                'besaran_uang'=>'required',
        ];
        $sms=[
                'kode_jabatan.required'=>'Jangan Kosong',
                'kode_jabatan.unique'=>'Data Tidak tersedia',
                'nama_jabatan.required'=>'Jangan Kosong',
                'besaran_uang.required'=>'Jangan Kosong',
        ];
        $validasi = Validator::make(Input::all(),$rules,$sms);
        if ($validasi->fails()) {
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();

        }
        $jabatan=Request::all();
        JabatanModel::create($jabatan);
        return redirect('Jabatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $jabatan=JabatanModel::find($id);
        return view('Jabatan.show',compact('jabatan'));
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
        $jabatan=JabatanModel::find($id);
        return view('Jabatan.edit',compact('jabatan'));
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

        $jabatan=JabatanModel::where('id',$id)->first();
        if($jabatan['kode_jabatan'] !=request('kode_jabatan')){
             $rules=[
                'kode_jabatan'=>'required|unique:jabatans',
                'nama_jabatan'=>'required',
                'besaran_uang'=>'required',];
        }
        else{
             $rules=[
                'kode_jabatan'=>'required|unique:jabatans',
                'nama_jabatan'=>'required',
                'besaran_uang'=>'required',];
        }
        $sms=[
                'kode_jabatan.required'=>'Jangan Kosong',
                'kode_jabatan.unique'=>'Data Tidak tersedia',
                'nama_jabatan.required'=>'Jangan Kosong',
                'besaran_uang.required'=>'Jangan Kosong',
        ];
        $validasi = Validator::make(Input::all(),$rules,$sms);
        if ($validasi->fails()) {
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();
        }
        $jabatanUpdate=Request::all();
        $jabatan=JabatanModel::find($id);
        $jabatan->update($jabatanUpdate);
        return redirect(route('Jabatan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         JabatanModel::find($id)->delete();
         return redirect('Jabatan');
    }
}
