<?php

namespace App\Http\Controllers;

use Request;
use App\GolonganModel;
use Validator;
use Input;
class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $golongan=GolonganModel::all();
        return view('Golongan.index',compact('golongan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('Golongan.create');
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
                'kode_golongan'=>'required|unique:golongans,kode_golongan',
                'nama_golongan'=>'required',
                'besaran_uang'=>'required',
        ];
        $sms=[
                'kode_golongan.required'=>'Jangan Kosong',
                'kode_golongan.unique'=>'Data Tidak tersedia',
                'nama_golongan.required'=>'Jangan Kosong',
                'besaran_uang.required'=>'Jangan Kosong',
        ];
        $validasi = Validator::make(Input::all(),$rules,$sms);
        if ($validasi->fails()) {
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();

        }
        $golongan=Request::all();
        GolonganModel::create($golongan);
        return redirect('Golongan');
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
        $golongan=GolonganModel::find($id);
        return view('Golongan.show',compact('golongan'));
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
        $golongan=GolonganModel::find($id);
        return view('Golongan.edit',compact('golongan'));
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
        //
        $jabatan=GolonganModel::where('id',$id)->first();
        if($jabatan['kode_jabatan'] !=request('kode_jabatan')){
             $rules=[
                'kode_golongan'=>'required|unique:golongans',
                'nama_golongan'=>'required',
                'besaran_uang'=>'required'];
        }
        else{
             $rules=[
                'kode_golongan'=>'required|unique:golongans',
                'nama_golongan'=>'required',
                'besaran_uang'=>'required'];
        }
        $sms=[
                'kode_golongan.required'=>'Jangan Kosong',
                'kode_golongan.unique'=>'Data Tidak tersedia',
                'nama_golongan.required'=>'Jangan Kosong',
                'besaran_uang.required'=>'Jangan Kosong',
        ];
        $validasi = Validator::make(Input::all(),$rules,$sms);
        if ($validasi->fails()) {
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();
        }
        $golonganUpdate=Request::all();
        $golongan=GolonganModel::find($id);
        $golongan->update($golonganUpdate);
        return redirect('Golongan');
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
         GolonganModel::find($id)->delete();
         return redirect('Golongan');
    }
}
