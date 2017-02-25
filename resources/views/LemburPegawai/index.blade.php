@extends('layouts.app')

@section('content')
 <h1>Lembur Pegawai</h1>
 <a href="{{url('/LemburPegawai/create')}}" class="btn btn-success">Tambah Lembur</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr class="bg-info">
         <th>No.</th>
         <th>Kode lembur</th>
         <th>Nama pegawai</th>
         <th>jumlah jam</th>
         <th colspan="2" >Action</th>
         </tr>
         </thead>
         <tbody>
         @foreach($lembur_pegawai as $lembur_pegawais)
                                                <tr>
                                                    <td>{{$lembur_pegawais->kategori_lembur->kode_lembur}}</td>
                                                    <td>{{$lembur_pegawais->pegawai->user->name}}</td>
                                                    
                                                    <td>{{$lembur_pegawais->jumlah_jam}}</td>
             <td><a href="{{route('LemburPegawai.edit',$data->id)}}" class="btn btn-warning">Edit</a></td>
             <td>
             {!! Form::open(['method' => 'DELETE', 'route'=>['LemburPegawai.destroy', $data->id]]) !!}
             {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
             {!! Form::close() !!}
             </td>
         </tr>
     @endforeach

     </tbody>

 </table>
@endsection