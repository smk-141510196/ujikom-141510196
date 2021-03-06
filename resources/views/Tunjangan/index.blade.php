@extends('layouts.app')

@section('content')
 <h1>Tunjangan</h1>
 <a href="{{url('/Tunjangan/create')}}" class="btn btn-success">Tambah Tunjangan</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr class="bg-info">
         <th>No.</th>
         <th>Kode Tunjangan</th>
         <th>Nama Jabatan</th>
         <th>Nama Golongan</th>
         <th>Status</th>
         <th>Jumlah Anak</th>
         <th>Besaran Uang</th>
         <th colspan="3">Actions</th>
     </tr>
     </thead>
     @php
     $n=1;
     @endphp
     <tbody>
     @foreach ($tunjangan as $data)
         <tr>
             <td>{{ $n++ }}</td>
             <td>{{ $data->kode_tunjangan}}</td>
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