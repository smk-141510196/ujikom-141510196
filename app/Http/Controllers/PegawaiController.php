<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use Input;
use App\PegawaiModel;
use App\User;
use App\JabatanModel;
use App\GolonganModel;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
class PegawaiController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   use RegistersUsers;
   public function index()
   {
       $pegawai=PegawaiModel::all();
       return view ('Pegawai.index',compact('pegawai'));
       // dd($pegawai);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       $jabatan=JabatanModel::all();
       $user=User::all();
       $golongan=GolonganModel::all();
       return view('Pegawai.create',compact('jabatan','user','golongan'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
    

        $this->Validate($request,['name'=>'required','email'=>'required|unique:users','permission'=>'required','password'=>'required','nip'=>'required|numeric','id_golongan'=>'required','id_jabatan'=>'required','poto'=>'required']);

       
       
       $file = Input::File('photo');
       $destinationPath = public_path().'/assets/image';
       $filename = $file->getClientOriginalName();
       $uploadSuccess = $file->move($destinationPath, $filename);


       if(Input::hasFile('photo')){
           $user=new User;
           $user->name=Input::get('name');
           $user->email=Input::get('email');
           $user->permission=Input::get('permision');
           $user->password=bcrypt(Input::get('password'));
           $user->save();
           $pegawai = new Pegawai;
           $pegawai->nip=Input::get('nip');
           $pegawai->golongan_id=Input::get('golongan_id');
           $pegawai->jabatan_id=Input::get('jabatan_id');
           $pegawai->id_user=$user->id;
           $pegawai->photo=$filename;
           $pegawai->save();
           return redirect('Pegawai');
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
}

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id **/
 public function edit($id)
   {
       $pegawai=Pegawai::find($id);
       $jabatan=Jabatan::all();
       $golongan=Golongan::all();
       return view('pegawai.edit',compact('pegawai','jabatan','golongan'));
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
       $update = Pegawai::where('id', $id)->first();
       $user = User::where('id', $id)->first();
       $user->permission=$request['permission'];
       $user->email=$request['email'];
       $user->name=$request['name'];
       $user->update();
       $update->nip = $request['nip'];
       $update->id_golongan = $request['id_golongan'];
       $update->id_jabatan = $request['id_jabatan'];

       if($request->file('poto') == "")
       {
           $update->photo = $update->photo;
       } 
       else
       {
           $file       = $request->file('poto');
           $fileName   = $file->getClientOriginalName();
           $request->file('poto')->move("image/", $fileName);
           $update->poto = $fileName;
       }
       
       $update->update();
       return redirect(route('Pegawai.index'));
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       $pegawai=PegawaiModel::find($id);
       
       $user=User::where('id',$pegawai->id_user)->delete();
       $pegawai->delete();
       // dd($pegawai);
       return redirect('pegawai');
   }
}