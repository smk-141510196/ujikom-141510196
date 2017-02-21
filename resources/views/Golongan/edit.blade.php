@extends('layouts.app')
@section('content')
    <h1>Edit Golongan</h1>
    {!! Form::model($golongan,['method' => 'PATCH','route'=>['Golongan.update',$golongan->id]]) !!}
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
        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop