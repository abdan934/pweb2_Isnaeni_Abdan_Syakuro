@extends('layout/layout_dashboard')

@section('konten')

<!-- Vertical Layout | With Floating Label -->

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    MAHASISWA
                </h2>
                
            </div>
            <div class="body">
                <form method="POST" action="{{'/mahasiswa/'.$data->nim}}">
                    @csrf
                    @method('PUT')
                <div class="row clearfix">

                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="nim" name="nim" value="{{$data->nim}}" class="form-control" required disabled>
                                <label class="form-label">NIM</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="nama_mhs" name="nama_mhs" value="{{$data->nama_mhs}}" class="form-control" required>
                                <label class="form-label">Nama Mahasiswa</label>
                            </div>
                        </div>
                    </div>
                    


                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="email" id="email" name="email" value="{{$data->email}}" class="form-control" required>
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="jurusan" name="jurusan" value="{{$data->jurusan}}" class="form-control" required>
                                <label class="form-label">Jurusan</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                    <button type="button submit" class="btn btn-primary m-t-15 waves-effect form-control">Ubah</button>
                    </div>
                </div>
                </form>

                <a href="{{ url('/mahasiswa') }}">
                    <button type="button" class="btn btn-default waves-effect">
                        <div class="demo-google-material-icon"> <i class="material-icons">keyboard_backspace</i> <span class="icon-name">Kembali</span></div>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Vertical Layout | With Floating Label -->
    


</div>
@endsection