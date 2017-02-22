@extends('layouts.app')
@section('Jabatan')
active
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Jabatan</div>
                <div class="panel-body">
                    {!! Form::model($jabatan,['method' => 'PATCH','route'=>['Jabatan.update',$jabatan->id]]) !!}
                        {!!Form::hidden('id',null,['class'=>'form-control'])!!}
                        <div class="form-group{{ $errors->has('kode_jabatan') ? ' has-error' : '' }}">
                            <label for="kode_jabatan" class="col-md-4 control-label">Kode Jabatan</label>

                            <div class="col-md-6">
                                {!!Form::text('kode_jabatan',null,['class'=>'form-control'])!!}
                              @if ($errors->has('kode_jabatan'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('kode_jabatan') }}</strong>
                             </span>
                                @endif
                           </div>
                        </div>

                        <div class="form-group{{ $errors->has('nama_jabatan') ? ' has-error' : '' }}">
                            <label for="nama_jabatan" class="col-md-4 control-label">Nama Jabatan</label>

                            <div class="col-md-6">
                                {!!Form::text('nama_jabatan',null,['class'=>'form-control'])!!}

                                @if ($errors->has('nama_jabatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_jabatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('besaran_uang') ? ' has-error' : '' }}">
                            <label for="besaran_uang" class="col-md-4 control-label">Besaran Uang</label>

                            <div class="col-md-6">
                                {!!Form::number('besaran_uang',null,['class'=>'form-control'])!!}
                                @if ($errors->has('besaran_uang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('besaran_uang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                            
                        </div>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
