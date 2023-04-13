@extends('layout/layout_dashboard')

@section('konten')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a href="{{ url('/mahasiswa/create') }}">
                <button type="button" class="btn btn-primary waves-effect col-sm-3 col-xs-2">
                    <div class="demo-google-material-icon"> <i class="material-icons">note_add</i> <span class="icon-name">Tambah Data</span> </div>
                </button>
                </a>
                <br><br><br>
                <div class="text-center">
                <h2><b>
                    DATA MAHASISWA
                </b></h2>
            </div>
            </div>
            <div class="body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                           
                            <th scope="row">{{$no++}}</th>
                            <td>{{$item->nim}}</td>
                            <td>{{$item->nama_mhs}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->jurusan}}</td>
                            <td>
                                    <a href="{{url('/mahasiswa/'.$item->nim.'/edit')}}">
                                        <button type="button" class="btn btn-info waves-effect form-control">Edit</button>
                                    </a>
                            </td>
                            <td>
                                <form onsubmit="return confirm('Yakin ingin menghapus?')" class="d-inline" action="{{'/mahasiswa/'.$item->nim}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                <button type="submit" class="btn btn-danger waves-effect form-control" data-toggle="modal" data-target="#smallModal">Hapus</button>
                                {{-- <button type="button" class="btn btn-danger waves-effect">Hapus</button> --}}
                                
                                   
                                </form>

                        </td>
                    </tr>
                    @endforeach
                        
                    </tbody>
                </table>
                {{$data->links()}}
                
            </div>
        </div>
    </div>
</div>
<!-- #END# Hover Rows -->
    


</div>
@endsection