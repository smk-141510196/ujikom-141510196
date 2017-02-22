<?php

namespace App\Http\Controllers;

use Request;
use App\JabatanModel;
use App\GolonganModel;
use App\KategoriLemburModel;
use Validator;
use Input;

class KategoriLemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategorilembur=KategoriLemburModel::with('JabatanModel','GolonganModel')->get();
        return view('KategoriLembur.index',compact('kategorilembur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $kategorilembur =KategoriLemburModel::all();
         $jabatan = JabatanModel::all();
         $golongan = GolonganModel::all();        
         return view('KategoriLembur.create',compact('kategorilembur','jabatan','golongan'));
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
                'kode_lembur'=>'required|unique:kategori_lemburs,kode_lembur',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'besaran_uang'=>'required'
        ];
        $sms=[
                'kode_lembur.required'=>'Jangan Kosong',
                'kode_lembur.unique'=>'Data Tidak tersedia',
                'jabatan_id.required'=>'Jangan Kosong',
                'golongan_id.required'=>'Jangan Kosong',
                'besaran_uang.required'=>'Jangan Kosong',
        ];
        $validasi = Validator::make(Input::all(),$rules,$sms);
        if ($validasi->fails()) {
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();

        }
        $kategorilembur=Request::all();
        KategoriLemburModel::create($kategorilembur);
        return redirect('KategoriLembur');
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
        $kategorilembur=KategoriLemburModel::find($id);
        return view('KategoriLembur.show',compact('kategorilembur'));
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
         $jabatan = JabatanModel::all();
         $golongan = GolonganModel::all(); 
         $kategorilembur=KategoriLemburModel::find($id);
         
        return view('KategoriLembur.edit',compact('kategorilembur','jabatan','golongan'));
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

        $kategorilembur=KategoriLemburModel::where('id',$id)->first();
        if($kategorilembur['kode_lembur'] !=request('kode_lembur')){
             $rules=[
                'kode_lembur'=>'required|unique:kategori_lemburs,kode_lembur',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'besaran_uang'=>'required'];
        }
        else{
             $rules=[
                'kode_lembur'=>'required',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'besaran_uang'=>'required'];
        }
        $sms=[
                'kode_lembur.required'=>'Jangan Kosong',
                'jabatan_id.required'=>'Jangan Kosong',
                'golongan_id.required'=>'Jangan Kosong',
                'besaran_uang.required'=>'Jangan Kosong',
        ];
        $validasi = Validator::make(Input::all(),$rules,$sms);
        if ($validasi->fails()) {
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();
        }
        $kategoriUpdate=Request::all();
        $kategorilembur=KategoriLemburModel::find($id);
        $kategorilembur->update($kategoriUpdate);
        return redirect(route('KategoriLembur.index'));
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
         KategoriLemburModel::find($id)->delete();
         return redirect('KategoriLembur');
    }
}
