@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-md-6 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Register User</div>
                <div class="panel-body">
                    <form class="form-horizontal"  method="POST" action="{{ url('/Pegawai') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label"> <h4 class="animated fadeInLeft">Name</h4></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                {{ $errors->first('name', ':message')  }}
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('permision') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label"> <h4>permision</h4></label>

                            <div class="col-md-6">
                               <td>
            <select name="permision" class="form-control">
           
            <option value="">pilih</option>
            <option value="Hrd">HRD</option>
            <option value="Keuangan">Keuangan</option>
            <option value="Admin">Admin</option>
            <option value="Pegawai">Pegawai</option>
              
            </select>

        {{ $errors->first('permision', ':message')  }}
        </td>

                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label"> <h4 class="animated fadeInLeft">E-Mail Address</h4></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                                   {{ $errors->first('email', ':message')  }}
  
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label"> <h4 class="animated fadeInLeft">Password</h4></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                              {{ $errors->first('password', ':message')  }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label"> <h4 class="animated fadeInLeft">Confirm Password</h4></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        
                  

                </div>

            </div>

        </div>
       <div class="col-md-5 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Register Pegawai</div>
                <div class="panel-body">
                    
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nip</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="nip" value="{{ old('nip') }}"  autofocus>
                                 {{ $errors->first('nip', ':message')  }}
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('jabatan_id') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Jabatan</label>

                            <div class="col-md-6">
                                 <select name="jabatan_id" class="form-control">
                                 <option value="">pilih</option>
            @foreach ($jabatan as $jabatans)
            <option value="{{$jabatans->id}}">{{$jabatans->nama_jabatan}}</option>
            @endforeach
            </select>
                {{ $errors->first('jabatan_id', ':message')  }}
 
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('golongan_id') ? ' has-error' : '' }}">
                            <label  class="col-md-4 control-label">golongan</label>

                            <div class="col-md-6">
                                 <select name="golongan_id" class="form-control">
                                 <option value="">pilih</option>
            @foreach ($golongan as $golongans)
            <option value="{{$golongans->id}}">{{$golongans->nama_golongan}}</option>
            @endforeach
            </select>
                           {{ $errors->first('golongan_id', ':message')  }}     
                            </div>
                        </div>
<div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label  class="col-md-4 control-label">foto</label>

                            <div class="col-md-6">
                                <input  type="file"  name="photo" value="{{ old('photo') }}">
{{ $errors->first('photo', ':message')  }}
                                
                            </div>
                        </div>

                     

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
    </div>



</div>

      </div>
                          </div>
                        </div>                   
@endsection