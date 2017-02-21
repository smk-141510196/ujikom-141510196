<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TujanganModel extends Model
{
    //
    protected $table='tujangans'
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
