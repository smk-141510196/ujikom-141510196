@extends('layouts.app')

@section('content')
 <h1>Golongan</h1>
 <a href="{{url('/Golongan/create')}}" class="btn btn-success">Tambah</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr class="bg-info">
         <th>No.</th>
         <th>Kode Golongan</th>
         <th>Nama Golongan</th>
         <th>Besaran Uang</th>
         <th colspan="3">Actions</th>
     </tr>
     </thead>
     @php
     $n=1;
     @endphp
     <tbody>
     @foreach ($golongan as $data)
         <tr>
             <td>{{ $n++ }}</td>
             <td>{{ $data->kode_golongan }}</td>
             <td>{{ $data->nama_golongan }}</td>
             <td>{{ $data->besaran_uang }}</td>
             <td><a href="{{route('Golongan.edit',$data->id)}}" class="btn btn-warning">Edit</a></td>
             <td>
             {!! Form::open(['method' => 'DELETE', 'route'=>['Golongan.destroy', $data->id]]) !!}
             {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
             {!! Form::close() !!}
             </td>
         </tr>
     @endforeach

     </tbody>

 </table>
@endsection