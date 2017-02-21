@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Buat Jabatan</div>

                <div class="panel-body">
                   
    {!! Form::open(['url' => 'Jabatan']) !!}
    <div class="form-group">
        {!! Form::label('Kode Jabatan', 'Kode Jabatan :') !!}
        {!! Form::text('kode_jabatan',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Nama Jabatan', 'Nama Jabatan :') !!}
        {!! Form::text('nama_jabatan',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Besaran Uang', 'Besaran Uang:') !!}
        {!! Form::text('besaran_uang',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@stop

