<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('Jabatan','JabatanController');
Route::resource('Golongan','GolonganController');
Route::resource('KategoriLembur','KategoriLemburController');
Route::resource('Tunjangan','TunjanganController');
Route::resource('Pegawai','PegawaiController');
Route::resource('LemburPegawai','LemburPegawaiController');