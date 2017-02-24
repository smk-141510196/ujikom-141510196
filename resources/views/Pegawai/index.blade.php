@extends('layouts.app')

@section('content')
     <div class="col-md-0 col-sm-12">
                        <h3>Tabel Pegawai</h3>
           

                        <div class="col-md-0 col-sm-0">
                        <a href="{{url('Pegawai/create')}}"> <button class=" btn btn-circle btn-gradient btn-danger" value="primary">Tambah
                              </button></a>
                             
                              
                                 
              

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>nip</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                     <th>Permision</th>
                                                    <th>Nama Jabatan</th>
                                                    <th>Nama Golongan</th>
                                                    <th>photo</th>
                                                    <th colspan="3" >Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pegawai as $pegawais)
                                                <tr>
                                                    <td>{{$pegawais->nip}}</td>
                                                    <td>{{$pegawais->user->name}}</td>
                                                     <td>{{$pegawais->user->email}}</td>
                                                     <td>{{$pegawais->user->permision}}</td>
                                                     <td>{{$pegawais->JabatanModel->nama_jabatan}}</td>
                                                     <td>{{$pegawais->GolonganModel ->nama_golongan}}</td>

                                                    <td><img src="/assets/image/{{$pegawais->photo}}" width="50" height="50"></td>
                                                    <td>
                 <td><a href="{{route('Pegawai.edit',$data->id)}}" class="btn btn-warning">Edit</a></td>
              {!! Form::open(['method' => 'DELETE', 'route'=>['Pegawai.destroy', $pegawais->id]]) !!}
             {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
             {!! Form::close() !!}

             </td>
                                             
@endforeach
</tbody>
</table>
</div>

</div>
</div>
</div>
</div>
</div>
@endsection