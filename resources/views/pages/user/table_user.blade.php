@extends('layout/layout_dashboard')

@section('konten')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <br>&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="d-inline">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-lg-2">
                <button type="button" class="btn bg-green waves-effect form-control" data-toggle="modal" data-target="#defaultModal">
                    <div class="demo-google-material-icon"> <i class="material-icons">folder</i> <span class="icon-name">IMPORT</span> </div> 
            </div>
                <div class="col-lg-2">
                    <a href="{{asset('template.xlsx')}}">
                <button type="button" class="btn bg-light-green waves-effect form-control">
                    <div class="demo-google-material-icon"> <i class="material-icons">file_download</i> <span class="icon-name">DOWNLOAD</span></div>
                </button>
                </a>
             </div>
            </div>
            <div class="header">
                
                <br>
                <div class="text-center">
                <h2>
                   <b> DATA USER</b>
                </h2>
            </div>
                <br>
            </div>
            <div class="body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            {{-- <th>Password</th> --}}
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                           
                            <th scope="row">{{$no++}}</th>
                            <td hidden>{{$item->id}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            {{-- <td>{{$item->password}}</td> --}}
                            <td>
                                    <a href="{{url('/datauser/'.$item->id.'/edit')}}">
                                        <button type="button" class="btn btn-info waves-effect form-control">Edit</button>
                                    </a>
                            </td>
                            <td>
                                <form onsubmit="return confirm('Yakin ingin menghapus?')" class="d-inline" action="{{'/datauser/'.$item->id}}" method="post">
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

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Masukkan File Excel</h4>
            </div>
            <div class="modal-body">
                <form action="/importexcel" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="fallback">
                        <input name="file" type="file" multiple required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect">SAVE CHANGES</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
    


</div>
@endsection