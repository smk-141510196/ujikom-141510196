@extends('layouts.app')

@section('content')
 <h1>Pegawai</h1>
 <a href="{{url('/Pegawai/create')}}" class="btn btn-success"> Daftarkan Pegawai</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr class="bg-info">
         <th>No.</th>
         <th>nip</th>
         <th>user_id</th>
         <th>Nama Jabatan</th>
         <th>Nama Golongan</th>
         <th>photo</th>
         <th colspan="3">Actions</th>
     </tr>
     </thead>
     @php
     $n=1;
     @endphp
     <tbody>
     @foreach ($pegawai as $data)
         <tr>
             <td>{{ $n++ }}</td>
             <td>{{ $data->nip}}</td>
             <td>{{ $data->user_id}}</td>
             <td>{{ $data->JabatanModel->nama_jabatan }}</td>
             <td>{{ $data->GolonganModel->nama_golongan }}</td>
             <td>{{ $data->status }}</td>
             <td>{{ $data->jumlah_anak }}</td>
             <td>{{ $data->besaran_uang }}</td>
             <td><a href="{{route('Tunjangan.edit',$data->id)}}" class="btn btn-warning">Edit</a></td>
             <td>
             {!! Form::open(['method' => 'DELETE', 'route'=>['Tunjangan.destroy', $data->id]]) !!}
             {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
             {!! Form::close() !!}
             </td>
         </tr>
     @endforeach

     </tbody>

 </table>
@endsection