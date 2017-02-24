<?php

namespace App\Http\Controllers;

use App\GolonganModel;
use Request;
use Validator;
use Input;
use Redirect;
class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    { 
         $golongan=GolonganModel::orderby('id','desc')->paginate(5);
     if(request()->has('kode_golongan')){
            $golongan=GolonganModel::where('kode_golongan',request('kode_golongan'))->paginate(0);
        }
        return view('Golongan.index',compact('golongan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
       $rules = array(
            'kode_golongan'=>'required|unique:golongans',
            'nama_golongan'=>'required',
            'besaran_uang'=>'required'
            );

        $message= array(
            
            'nama_golongan.required'=>'Maaf Data Masih Kosong',
            'kode_golongan.required'=>'Maaf Data Masih Kosong',
            'kode_golongan.unique'=>'Data Tidak Tersedia',
            'besaran_uang.required'=>'Maaf Data Masih Kosong'
            
            );
       $validation = Validator::make(Input::all(), $rules, $message);
        if ($validation->fails())
        {
         return Redirect('Golongan/create')->withErrors($validation)->withInput();
        }

         $golongans=Request::all();
        GolonganModel::create($golongans);
        $golongan=GolonganModel::all();
        return redirect('golongan');
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
        
           $golongan=GolonganModel::where('id',$id)->first();
           if ($golongan['kode_golongan'] !=Request('kode_golongan')) {
                $rules = array(
            'kode_golongan'=>'required|unique:golongans',
            'nama_golongan'=>'required',
            'besaran_uang'=>'required'
            );
           }
           else{
            $rules = array(
            'kode_golongan'=>'required',
            'nama_golongan'=>'required',
            'besaran_uang'=>'required'
            );
           }
        $message= array(
            
            'nama_golongan.required'=>'Maaf Data Masih Kosong',
            'kode_golongan.required'=>'Maaf Data Masih Kosong',
            'kode_golongan.unique'=>'data sudah ada',
            'besaran_uang.required'=>'Maaf Data Masih Kosong'
            
            );
       $validation = Validator::make(Input::all(), $rules, $message);
        if ($validation->fails())
        {
           return Redirect::back()->withInput()->withErrors($validation->messages());
        }
        $update=Request::all();
        $golongan=GolonganModel::find($id);
        $golongan->update($update);
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
        $golongan=GolonganModel::find($id)->delete();
        return redirect('Golongan');
    }
}
