<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLemburPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur_pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kode_lembur_id')->unsigned();
            $table->foreign('kode_lembur_id')->on('kategori_lemburs')->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->integer('pegawai_id')->unsigned();
            $table->foreign('pegawai_id')->on('pegawais')->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->integer('jumlah_jam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lembur_pegawais');
    }
}
