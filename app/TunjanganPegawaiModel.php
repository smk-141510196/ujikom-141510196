<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TunjanganPegawaiModel extends Model
{
    //
    protected $table='tujangan_pegawais';
    protected $fillable=['id','kode_tunjangan_id','pegawai_id'];

    public function TunjanganModel(){
    	return $this->BelongsTo('App\TunjanganModel','kode_tunjangan_id');
    }
     public function PegawaiModel(){
    	return $this->BelongsTo('App\PegawaiModel','pegawai_id');
    }
     public function PenggajianModel(){
     	return $this->hasMany('App\PenggajianModel','tunjangan_pegawai_id');
     }
}
