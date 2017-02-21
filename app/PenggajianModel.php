<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggajianModel extends Model
{
    //
    protected $table='penggajians'
    protected $fillable=['id','tunjangan_pegawai_id','jumlah_jam_lembur','jumlah_uang_lembur','gaji_pokok','total_gaji','tanggal_pengambilan','status_pengambilan','petugas_penerima'];

    public function TunjanganPegawaiModel(){
    	return $this->BelongsTo('App\TunjanganPegawaiModel','tunjangan_pegawai_id');
    }
}
