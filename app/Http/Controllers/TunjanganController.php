<?php

namespace App\Http\Controllers;

use Request;
use App\JabatanModel;
use App\GolonganModel;
use App\TunjanganModel;
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
        //
        $tunjangan=TunjanganModel::with('JabatanModel','GolonganModel')->get();
        return view('Tunjangan.index',compact('tunjangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $tunjangan =TunjanganModel::all();
         $jabatan = JabatanModel::all();
         $golongan = GolonganModel::all();        
         return view('Tunjangan.create',compact('tunjangan','jabatan','golongan'));
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
                'kode_tunjangan'=>'required|unique:tunjangans,kode_tunjangan',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'status'=>'required',
                'jumlah_anak'=>'required|min:0',
                'besaran_uang'=>'required'
        ];
        $sms=[
                'kode_tunjangan.required'=>'Jangan Kosong',
                'kode_tunjangan.unique'=>'Data Tidak tersedia',
                'jabatan_id.required'=>'Jangan Kosong',
                'golongan_id.required'=>'Jangan Kosong',
                'status.required'=>'Jangan Kosong',
                'jumlah_anak.required'=>'Jangan Kosong',
                'jumlah_anak.min'=>'ERROR',
                'besaran_uang.required'=>'Jangan Kosong',
        ];
        $validasi = Validator::make(Input::all(),$rules,$sms);
        if ($validasi->fails()) {
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();

        }
        $tunjangan=Request::all();
        TunjanganModel::create($tunjangan);
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
        $tunjangan=TunjanganModel::find($id);
        return view('Tunjangan.show',compact('tunjangan'));
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
         $tunjangan=TunjanganModel::find($id);
         
        return view('Tunjangan.edit',compact('tunjangan','jabatan','golongan'));
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

        $tunjangan=TunjanganModel::where('id',$id)->first();
        if($tunjangan['kode_tunjangan'] !=request('kode_tunjangan')){
             $rules=[
                'kode_tunjangan'=>'required|unique:tunjangans,kode_tunjangan',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'status'=>'required',
                'jumlah_anak'=>'required',
                'besaran_uang'=>'required'];
        }
        else{
             $rules=[
                'kode_tunjangan'=>'required',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'status'=>'required',
                'jumlah_anak'=>'required|min>=0',
                'besaran_uang'=>'required'];
        }
        $sms=[
                'kode_tunjangan.required'=>'Jangan Kosong',
                'kode_tunjangan.unique'=>'Data Tidak tersedia',
                'jabatan_id.required'=>'Jangan Kosong',
                'golongan_id.required'=>'Jangan Kosong',
                'status.required'=>'Jangan Kosong',
                'jumlah_anak.required'=>'Jangan Kosong',
                'jumlah_anak.min'=>'ERROR',
                'besaran_uang.required'=>'Jangan Kosong',
        ];
        $validasi = Validator::make(Input::all(),$rules,$sms);
        if ($validasi->fails()) {
            return redirect()->back()
            ->withErrors($validasi)
            ->withInput();
        }
        $tunjanganUpdate=Request::all();
        $tunjangan=TunjanganModel::find($id);
        $tunjangan->update($tunjanganUpdate);
        return redirect(route('Tunjangan.index'));
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
         TunjanganModel::find($id)->delete();
         return redirect('Tunjangan');
    }
}
