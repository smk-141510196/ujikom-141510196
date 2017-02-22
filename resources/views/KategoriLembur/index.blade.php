@extends('layouts.app')

@section('content')
 <h1>Kategori Lembur</h1>
 <a href="{{url('/KategoriLembur/create')}}" class="btn btn-success">Tambah Kategori</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr class="bg-info">
         <th>No.</th>
         <th>Kode lembur</th>
         <th>Nama Jabatan</th>
         <th>Nama Golongan</th>
         <th>Besaran Uang</th>
         <th colspan="3">Actions</th>
     </tr>
     </thead>
     @php
     $n=1;
     @endphp
     <tbody>
     @foreach ($kategorilembur as $data)
         <tr>
             <td>{{ $n++ }}</td>
             <td>{{ $data->kode_lembur}}</td>
             <td>{{ $data->JabatanModel->nama_jabatan }}</td>
             <td>{{ $data->GolonganModel->nama_golongan }}</td>
             <td>{{ $data->besaran_uang }}</td>
             <td><a href="{{route('KategoriLembur.edit',$data->id)}}" class="btn btn-warning">Edit</a></td>
             <td>
             {!! Form::open(['method' => 'DELETE', 'route'=>['KategoriLembur.destroy', $data->id]]) !!}
             {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
             {!! Form::close() !!}
             </td>
         </tr>
     @endforeach

     </tbody>

 </table>
@endsection