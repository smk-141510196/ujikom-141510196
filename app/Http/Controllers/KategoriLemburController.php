<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\GolonganModel;
use App\JabatanModel;
use App\KategoriLemburModel;
use Validator;
use Redirect;
class KategoriLemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {
        $kategori_lembur=KategoriLemburModel::orderby('id','desc')->paginate(5);
        if(request()->has('kode_lembur')){
            $kategori_lembur=KategoriLemburModel::where('kode_lembur',request('kode_lembur'))->paginate(0);
        }
        return view('KategoriLembur.index',compact('kategori_lembur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan=JabatanModel::all();
         $golongan=GolonganModel::all();
        return view('KategoriLembur.create',compact('jabatan','golongan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'kode_lembur'=>'required|unique:kategori_lemburs',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'besaran_uang'=>'required'
            );

        $message= array(
            
            'jabatan_id.required'=>'Maaf Data Masih Kosong',
            'golongan_id.required'=>'Maaf Data Masih Kosong',
            'kode_lembur.required'=>'Maaf Data Masih Kosong',
            'kode_lembur.unique'=>'Data Tidak Tersedia',
            'besaran_uang.required'=>'Maaf Data Masih Kosong'
            
            );
       $validation = Validator::make(Input::all(), $rules, $message);
        if ($validation->fails())
        {
         return Redirect('KategoriLembur/create')->withErrors($validation)->withInput();
        }

            $kategori = new Kategori_lembur;
            $kategori->kode_lembur = $request->get('kode_lembur');
            $kategori->jabatan_id = $request->get('jabatan_id');
            $kategori->golongan_id = $request->get('golongan_id');
            $kategori->besaran_uang = $request->get('besaran_uang');
            
            
            $kategori->save();
            
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $kategori_lembur=KategoriLemburModel::find($id);
         $jabatan=JabatanModel::all();
         $golongan=GolonganModel::all();
        return view('KategoriLembur.edit',compact('kategori_lembur','jabatan','golongan'));
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
        $kategori = KategoriLemburModel::find($id);
        $kategori_lembur=KategoriLemburModel::where('id',$id)->first();
           if ($kategori_lembur['kode_lembur'] !=Request('kode_lembur')) {
                 $rules = array(
            'kode_lembur'=>'required|unique:kategori_lemburs',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'besaran_uang'=>'required'
            );
           }
           else{
            $rules = array(
            'kode_lembur'=>'required',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'besaran_uang'=>'required'
            );
           }

        $message= array(
            
            'jabatan_id.required'=>'Maaf Data Masih Kosong',
             'golongan_id.required'=>'Maaf Data Masih Kosong',
            'kode_lembur.required'=>'Maaf Data Masih Kosong',
            'kode_lembur.unique'=>'Data Tidak Tersedia',
            'besaran_uang.required'=>'Maaf Data Masih Kosong'
            
            );
       $validation = Validator::make(Input::all(), $rules, $message);
        if ($validation->fails())
        {
           return Redirect::back()->withInput()->withErrors($validation->messages());
        }
    
            $kategori->kode_lembur = $request->get('kode_lembur');
            $kategori->jabatan_id = $request->get('jabatan_id');
            $kategori->golongan_id = $request->get('golongan_id');
            $kategori->besaran_uang = $request->get('besaran_uang');
            $kategori->save();
        return redirect('KategoriLembur');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori_lembur=KategoriLemburModel::find($id)->delete();
        return redirect('kategori_lembur');
    }
}
