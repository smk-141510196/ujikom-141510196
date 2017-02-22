<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PegawaiModel extends Model
{
    //
    protected $table='pegawais';
    protected $fillable=['id','nip','user_id','jabatan_id','golongan_id','photo'];

    public function GolonganModel(){
    	return $this->BelongsTo('App\GolonganModel','golongan_id');
    }
     public function JabatanModel(){
    	return $this->BelongsTo('App\JabatanModel','jabatan_id');
    }
     public function User(){
    	return $this->BelongsTo('App\User','user_id');
    }
     public function LemburPegawaiModel(){
    	return $this->hasMany('App\LemburPegawaiModel','pegawai_id');
    }
    public function TunjanganPegawaiModel(){
    	return $this->hasOne('App\TunjanganPegawaiModel','pegawai_id');
    }
}
