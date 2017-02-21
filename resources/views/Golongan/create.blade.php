@extends('layouts.app')
@section('content')
    <h1>Buat Golongan</h1>
    {!! Form::open(['url' => 'Golongan']) !!}
    <div class="form-group">
        {!! Form::label('Kode Golongan', 'Kode Golongan :') !!}
        {!! Form::text('kode_golongan',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Nama Golongan', 'Nama Golongan :') !!}
        {!! Form::text('nama_golongan',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Besaran Uang', 'Besaran Uang:') !!}
        {!! Form::text('besaran_uang',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@stop