@extends('layout/layout_dashboard')

@section('konten')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <br>
                <h2 class="text-center">
                   <b> DATA NILAI </b>
                </h2>
                <br><br>
                
            </div>
            <div class="body table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-active">
                        <tr>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Predikat</th>
                            {{-- <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th rowspan="2">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item->id_matkul}}</td>
                            <td>{{$item->nama_matkul}}</td>
                            <td>{{$item->predikat}}</td>
                            {{-- <td>{{$item->tahun_ajaran}}</td>
                            <td>{{$item->semester}}</td> --}}
                            
                            {{-- <td>
                                    <a href="{{url('/nilai/'.$item->no_nilai)}}" class="btn btn-info waves-effect form-control">Edit</button>
                                    </a>
                            </td>
                            <td>
                                <form onsubmit="return confirm('Yakin ingin menghapus?')" class="d-inline" action="{{'/nilai/'.$item->no_nilai}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                <button type="submit" class="btn btn-danger waves-effect form-control" data-toggle="modal" data-target="#smallModal">Hapus</button>
                                <button type="button" class="btn btn-danger waves-effect">Hapus</button>
                                
                                   
                                </form> --}}
                        </td>
                        {{-- <td hidden>{{$item->no}}</td> --}}
                    </tr>
                    @endforeach
                        
                    </tbody>
                </table>
                <form class="d-inline" action="/nilaipersemester/semester" method="post">
                    @csrf
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                    <select class="form-select" name="tahun_ajaran" aria-label="Default select example" value="{{Session::get('tahun_ajaran')}}">
                        <option selected>Tahun Ajaran</option>
                        <option value="2021/2022">2021/2022</option>
                        <option value="2022/2023">2022/2023</option>
                        <option value="2023/2024">2023/2024</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                    <div class="form-line">
                        <input name="semester" type="radio" class="with-gap" id="radio_1" value="GANJIL" />
                        <label for="radio_1">Ganjil</label>
                        <input name="semester" type="radio" id="radio_2" class="with-gap" value="GENAP" />
                        <label for="radio_2">Genap</label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                    <button type="submit" class="btn btn-primary">Tampilkan Data</button>
                </div>
                </form>
                {{-- {{$data->links()}} --}}

            </div>
            
        </div>
        
    </div>
</div>
<!-- #END# Hover Rows -->

    


</div>
@endsection