<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TunjanganModel extends Model
{
    //
    protected $table='tunjangans';
    protected $fillable=['id','kode_tunjangan','jabatan_id','golongan_id','status','jumlah_anak','besaran_uang'];

    public function GolonganModel(){
    	return $this->BelongsTo('App\GolonganModel','golongan_id');
    }
     public function JabatanModel(){
    	return $this->BelongsTo('App\JabatanModel','jabatan_id');
    }
     public function TujanganPegawaiModel(){
     	return $this->hasMany('App\TujanganPegawaiModel','kode_tunjangan_id');
     }
}
