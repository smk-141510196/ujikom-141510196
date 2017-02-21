<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GolonganModel extends Model
{
    //
    protected $table='golongans';
    protected $fillable=['id','kode_golongan','nama_golongan','besaran_uang'];

    public function KategoriLemburModel(){
    	return $this->hasMany('App\KategoriLemburModel','golongan_id');
    }
     public function PegawaiModel(){
    	return $this->hasMany('App\PegawaiModel','golongan_id');
    }
     public function TunjanganModel(){
    	return $this->hasMany('App\TunjanganModel','golongan_id');
    }
}
