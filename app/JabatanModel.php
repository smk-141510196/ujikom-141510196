<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    //
    protected $table='jabatans';
    protected $fillable=['id','kode_jabatan','nama_jabatan','besaran_uang'];

    public function KategoriLemburModel(){
    	return $this->hasMany('App\KategoriLemburModel','jabatan_id');
    }
     public function PegawaiModel(){
    	return $this->hasMany('App\PegawaiModel','jabatan_id');
    }
     public function TunjanganModel(){
    	return $this->hasMany('App\TunjanganModel','jabatan_id');
    }
}	
