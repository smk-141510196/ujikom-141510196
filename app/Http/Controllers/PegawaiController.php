<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PegawaiModel;
use App\GolonganModel;
use App\JabatanModel;
use App\KategoriLemburModel;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Input;
class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  public function __construct()
    // {
    //     $this->middleware('hrd');
    // }
        use RegistersUsers;
    public function index()
    {
        $pegawai=PegawaiModel::orderby('id','desc')->paginate(5);
        // $golongan=Golongan::all();
        // $jabatan=Jabatan::all();
        // $user=User::all();
          if(request()->has('nip')){
            $pegawai=PegawaiModel::where('nip',request('nip'))->paginate(0);
        }
        return view('Pegawai.index',compact('pegawai','GolonganModel','user','JabatanModel'));    
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
        return view('Pegawai.create',compact('jabatan','golongan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $rules = array('email' => 'required|unique:users',
                        'password' => 'required|min:6|confirmed',
                        'name' => 'required',
                        'permision' =>'required',
                        'nip' => 'required|min:11|numeric|unique:pegawais',
                        'jabatan_id' =>'required',
                        'golongan_id' => 'required',
                        'photo' => 'required'
                        
                         );
        $message =array('email.unique' =>'Data Tidak Tersedia' ,
                        'name.required' =>'Wajib Isi',
                        'email.required' =>'Wajib Isi',
                        'password.required' =>'wajib isi',
                        'password.confirmed' =>'Masukan Password Yang Benar',
                        'permision.required' =>'Wajib isi',
                        'nip.unique' =>'Data Tidak Tersedia',
                        'nip.required' =>'Wajib isi',
                        'nip.min' =>'Minimal 11 karakter',
                        'nip.numeric' =>'Input Dengan Angka',
                        'jabatan_id.required' =>'Wajib isi',
                        'golongan_id.required' =>'Wajib isi',
                        'photo.required' =>'Wajib isi');

       // $validation = Validator::make(Input::all(), $rules, $message);
       //  if ($validation->fails())
       //  {
       //   return Redirect('Pegawai/create')->withErrors($validation)->withInput();
       //  }

        $file = Input::file('photo');
        $destinationPath = public_path().'/assets/image/';
        $filename = $file-> getClientOriginalName();
        $uploadSuccess = $file->move($destinationPath, $filename);

        if(Input::hasFile('photo')){
          
            $user= User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'permision' => $request->get('permision'),
            'password' => bcrypt($request->get('password')),
        ]);
            $pegawai = new PegawaiModel;
            $pegawai->nip = $request->get('nip');
            $pegawai->jabatan_id = $request->get('jabatan_id');
            $pegawai->golongan_id = $request->get('golongan_id');
            $pegawai->user_id = $user->id;
            
            $pegawai->photo = $filename;
            $pegawai->save();
            $lama = KategoriLemburModel::where('jabatan_id',$pegawai->jabatan_id)->where('golongan_id',$pegawai->golongan_id)->first();
            // dd($lama);
            if (isset($lama)) {
            $error=true ;
            $pegawai=PegawaiModel::paginate(5);
            return view('Pegawai.index',compact('pegawai'));
        }
    }
         $kategorilembur=new KategoriLemburModel ;
         $kategorilembur->jabatan_id =$pegawai->jabatan_id;
         $kategorilembur->golongan_id=$pegawai->golongan_id;
         $a =date('dmys');
         $kategorilembur->kode_lembur="KODEKAT".$a."-".$pegawai->jabatan_id."-".$pegawai->golongan_id ;
         $kategorilembur->besaran_uang=0 ;
         $kategorilembur->save();
             return redirect('pegawai');
         
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
         
         $pegawai=PegawaiModel::find($id);
         $jabatan=JabatanModel::all();
         $golongan=GolonganModel::all();
         return view('Pegawai.edit',compact('pegawai','jabatan','golongan'));
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
        

        $update=Input::all();
        $logo =Input::file('photo') ;
            $upload='/assets/image/';
            $filename=$logo->getClientOriginalName();
            $success=$logo->move($upload,$filename);
            if($success){
                $pegawai=new pegawai ;
                $pegawai=array('photo'=>$filename,
                                'nip'=>Input::get('nip'),
                                'jabatan_id'=>Input::get('jabatan_id'),
                                'golongan_id'=>Input::get('golongan_id'));
        

                pegawai::where('id',$id)->update($pegawai);
            return redirect('pegawai');
    }
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
        
        $user=User::where('id',$pegawai->user_id)->delete();
        $pegawai->delete();
        return redirect('pegawai');
    }
}
