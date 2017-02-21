@extends('layouts.app')

@section('content')
 <h1>Jabatan</h1>
 <a href="{{url('/Jabatan/create')}}" class="btn btn-success">Tambah</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr class="bg-info">
         <th>No.</th>
         <th>Kode Jabatan</th>
         <th>Nama Jabatan</th>
         <th>Besaran Uang</th>
         <th colspan="3">Actions</th>
     </tr>
     </thead>
     @php
     $n=1;
     @endphp
     <tbody>
     @foreach ($jabatan as $data)
         <tr>
             <td>{{ $n++ }}</td>
             <td>{{ $data->kode_jabatan }}</td>
             <td>{{ $data->nama_jabatan }}</td>
             <td>{{ $data->besaran_uang }}</td>
             <td><a href="{{route('Jabatan.edit',$data->id)}}" class="btn btn-warning">Update</a></td>
             <td>
             {!! Form::open(['method' => 'DELETE', 'route'=>['Jabatan.destroy', $data->id]]) !!}
             {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
             {!! Form::close() !!}
             </td>
         </tr>
     @endforeach

     </tbody>

 </table>
@endsection