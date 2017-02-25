@extends('layouts.app')

@section('content')
 <h1>Pegawai</h1>
 <a href="{{url('/Pegawai/create')}}" class="btn btn-success">Tambah</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr class="bg-info">
         <th>No.</th>
         <th>Nip</th>
         <th>Nama</th>
         <th>Email</th>
         <th>Permission</th>
         <th>Jabatan</th>
         <th>Golongan</th>  
         <th>Gambar</th>
         <th colspan="3">Actions</th>
     </tr>
     </thead>
     @php
     $n=1;
     @endphp
     <tbody>
     @foreach ($pegawai as $pegawais)
         <tr>
             <td>{{$n++}}</td>
             <td>{{$pegawais->nip}}</td>
             <td>{{$pegawais->user->name}}</td>
             <td>{{$pegawais->user->email}}</td>
             <td>{{$pegawais->user->permission}}</td>
             <td>{{$pegawais->JabatanModel->nama_jabatan}}</td>
             <td>{{$pegawais->GolonganModel ->nama_golongan}}</td>
             <td><img src="/assets/image/{{$pegawais->photo}}" width="50" height="50"></td>
             <td><a href="{{route('Pegawai.edit',$pegawais->id)}}" class="btn btn-warning">Edit</a></td>
             <td>{!! Form::open(['method' => 'DELETE', 'route'=>['Pegawai.destroy', $pegawais->id]]) !!}
             {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}</td>
             {!! Form::close() !!}

             </td>
         </tr>
     @endforeach

     </tbody>

 </table>
@endsection