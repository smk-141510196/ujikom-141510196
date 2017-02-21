<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LemburPegawaiModel extends Model
{
    //
    protected $table='lembur_pegawais'
    protected $fillable=['id','kode_lembur_id','pegawai_id','jumlah_jam'];

    public function KategoriLemburModel(){
    	return $this->BelongsTo('App\KategoriLemburModel','kode_lembur_id');
    }
     public function PegawaiModel(){
    	return $this->BelongsTo('App\PegawaiModel','pegawai_id');
    }
}
