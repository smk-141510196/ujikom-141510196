<?php

namespace App\Http\Controllers;

use Request;
use App\TunjanganModel;
use App\GolonganModel;
use App\JabatanModel;
use Validator;
use Input;
class TunjanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
         $tunjangan=TunjanganModel::orderby('id','desc')->paginate(5);
        if(request()->has('kode_tunjangan')){
            $tunjangan=TunjanganModel::where('kode_tunjangan',request('kode_tunjangan'))->paginate(0);
        }
        return view('Tunjangan.index',compact('tunjangan'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $jabatan=JabatanModel::all();
         $golongan=GolonganModel::all();
        return view('Tunjangan.create',compact('jabatan','golongan'));
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
            'kode_tunjangan'=>'required|unique:tunjangans',
            'status'=>'required',
            'jumlah_anak'=>'required',
            'besaran_uang'=>'required'
            );

        $message= array(
            
            'status.required'=>'Maaf Data Masih Kosong',
            'kode_tunjangan.required'=>'Maaf Data Masih Kosong',
            'kode_tunjangan.unique'=>'Data Tidak Tersedia',
            'jumlah_anak.required'=>'Maaf Data Masih Kosong',
            'besaran_uang.required'=>'Maaf Data Masih Kosong'
            
            );
       $validation = Validator::make(Input::all(), $rules, $message);
        if ($validation->fails())
        {
         return Redirect('Tunjangan/create')->withErrors($validation)->withInput();
        }

         $tunjangans=Request::all();
        TunjanganModel::create($tunjangans);
        $tunjangan=TunjanganModel::all();
        return redirect('Tunjangan');
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
        $tunjangan=TunjanganModel::find($id);
        $jabatan=JabatanModel::all();
        $golongan=GolonganModel::all();
        return view('Tunjangan.edit',compact('tunjangan','golongan','jabatan'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $tunjangan =TunjanganModel::find($id);
         if ($tunjangan['kode_tunjangan'] !=Request('kode_tunjangan')) {
                $rules = array(
            'kode_tunjangan'=>'required|unique:tunjangans',
            'status'=>'required',
            'jumlah_anak'=>'required',
            'besaran_uang'=>'required'
            );
           }
           else{
             $rules = array(
            'kode_tunjangan'=>'required',
            'status'=>'required',
            'jumlah_anak'=>'required',
            'besaran_uang'=>'required'
            );
           }
         

        $message= array(
            
            'status.required'=>'Maaf Data Masih Kosong',
            'kode_tunjangan.required'=>'Maaf Data Masih Kosong',
            'kode_tunjangan.unique'=>'data sudah ada',
            'jumlah_anak.required'=>'Maaf Data Masih Kosong',
            'besaran_uang.required'=>'Maaf Data Masih Kosong'
            
            );
       $validation = Validator::make(Input::all(), $rules, $message);
        if ($validation->fails())
        {
           return Redirect::back()->withInput()->withErrors($validation->messages());
        }
        $update=Request::all();
        $tunjangan=TunjanganModel::find($id);
        $tunjangan->update($update);
        return redirect('Tunjangan');
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tunjangan=TunjanganModel::find($id)->delete();
        return redirect('Tunjangan');    }
}
