<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip')->unique();
            $table->integer('jabatan_id')->unsigned();
            $table->foreign('jabatan_id')->on('jabatans')->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->integer('golongan_id')->unsigned();
            $table->foreign('golongan_id')->on('golongans')->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('Cascade')->onUpdate('Cascade');
            $table->string('photo');
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
        Schema::dropIfExists('pegawais');
    }
}
