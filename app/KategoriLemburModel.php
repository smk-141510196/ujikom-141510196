<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriLemburModel extends Model
{
    //
    protected $table='kategori_lemburs';
    protected $fillable=['id','kode_lembur','jabatan_id','golongan_id','besaran_uang'];

    public function GolonganModel(){
    	return $this->BelongsTo('App\GolonganModel','golongan_id');
    }
     public function JabatanModel(){
    	return $this->BelongsTo('App\JabatanModel','jabatan_id');
    }
     public function LemburPegawaiModel(){
    	return $this->hasMany('App\LemburPegawaiModel','kode_lembur_id');
    }
}
