<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LemburPegawaiModel;
use App\KategoriLemburModel;
use App\PegawaiModel;
use Validator;
use Input;
class LemburPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   // public function __construct()
   //  {
   //      $this->middleware('keuangan');
   //  }
    public function index()
    { 
//        $current = Carbon::now();

// // add 30 days to the current time
// $trialExpires = $current->addDays(30);
        
        $lembur_pegawai=LemburPegawaiModel::orderby('id','desc')->paginate(5);  
        $pegawai=PegawaiModel::all();
        
         
        
       // if ($lembur_pegawai=LemburPegawaiModel::find('id')) {
         //     }
       // else{
       //   $lembur_pegawai=LemburPegawaiModel::selectRaw("sum(lembur_pegawais.jumlah_jam) as jumlah_jam,lembur_pegawais.kode_lembur_id as kode_lembur_id,lembur_pegawais.pegawai_id as pegawai_id")
       //  ->GroupBy('kode_lembur_id','pegawai_id')->get();
       // }
         if(request()->has('kode_lembur')){
            $lembur_pegawai=LemburPegawaiModel::where('kode_lembur',request('kode_lembur'))->paginate(0);
        }
        return view('LemburPegawai.index',compact('lembur_pegawai','trialExpires','current'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $kategori_lembur=KategoriLemburModel::all();
      $pegawai=PegawaiModel::all();
          return view('LemburPegawai.create',compact('kategori_lembur','pegawai'));
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
            
            'pegawai_id'=>'required',
            'jumlah_jam'=>'required'
            );

        $message= array(
            
            'pegawai_id.required'=>'Maaf Data Masih Kosong',
          
            'jumlah_jam.required'=>'Maaf Data Masih Kosong'
            
            );
       $validation = Validator::make(Input::all(), $rules, $message);
        if ($validation->fails())
        {
         return Redirect('LemburPegawai/create')->withErrors($validation)->withInput();
        }
        else{
          $pegawai=PegawaiModel::where('id',Request('pegawai_id'))->first();
            $kategori_lembur=KategoriLemburModel::where('jabatan_id',$pegawai->jabatan_id)->where('golongan_id',$pegawai->golongan_id)->first();
            if (isset($kategori_lembur->id)) {
               $lembur_pegawai = new Lembur_pegawai;
            $lembur_pegawai->kode_lembur_id = $kategori_lembur->id;
            $lembur_pegawai->pegawai_id = $request->get('pegawai_id');
            
            $lembur_pegawai->jumlah_jam = $request->get('jumlah_jam');
             $lembur_pegawai->save();
             return redirect('LemburPegawai');
            }
            else{
            return redirect('error');
         }
         }
            
            
            
             
        
        
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
         $lembur_pegawai=LemburPegawaiModel::find($id);
         $kategori_lembur=KategoriLemburModel::all();
      $pegawai=PegawaiModel::all();
        return view('LemburPegawai.edit',compact('lembur_pegawai','kategori_lembur','pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { $lembur_pegawai =LemburPegawaiModel::find($id);
         if ($lembur_pegawai['kode_lembur_id'] !=Request('kode_lembur_id')) {
                 $rules = array(
            
            'jumlah_jam'=>'required'
            );
           }
           else{
            $rules = array(
           
            'jumlah_jam'=>'required'
            );
           }

     

        $message= array(
            
            
            'jumlah_jam.required'=>'Maaf Data Masih Kosong'
            
            );
       $validation = Validator::make(Input::all(), $rules, $message);
        if ($validation->fails())
        {
           return Redirect::back()->withInput()->withErrors($validation->messages());
        }
          $lembur_pegawai->kode_lembur_id = $request->get('kode_lembur_id');
            $lembur_pegawai->pegawai_id = $request->get('pegawai_id');
            $lembur_pegawai->jumlah_jam = $request->get('jumlah_jam');
            
            
            
            $lembur_pegawai->save();
            return redirect('LemburPegawai'); 
         }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lembur_pegawai=LemburPegawaiModel::selectRaw("sum(lembur_pegawais.jumlah_jam) as jumlah_jam,lembur_pegawais.kode_lembur_id as kode_lembur_id,lembur_pegawais.pegawai_id as pegawai_id")
        ->GroupBy('kode_lembur_id','pegawai_id')->delete();
        return redirect('LemburPegawai');    }
}