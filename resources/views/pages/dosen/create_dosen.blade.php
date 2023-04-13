@extends('layout/layout_dashboard')

@section('konten')

<!-- Vertical Layout | With Floating Label -->

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Dosen
                </h2>
                
            </div>
            <div class="body">
                <form method="POST" action="/dosen">
                    @csrf
                <div class="row clearfix">

                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="nidn" name="nidn" value="{{Session::get('nidn')}}" class="form-control" required>
                                <label class="form-label">NIDN</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="nama_dosen" name="nama_dosen" value="{{Session::get('nama_dosen')}}" class="form-control" required>
                                <label class="form-label">Nama Dosen</label>
                            </div>
                        </div>
                    </div>
                    


                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="email" id="email" name="email" value="{{Session::get('email')}}" class="form-control" required>
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="jurusan" name="jurusan" value="{{Session::get('jurusan')}}" class="form-control" required>
                                <label class="form-label">Jurusan</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 text-right">
                    <button type="button submit" class="btn btn-primary m-t-15 waves-effect form-control">Simpan</button>
                    </div>
                </div>
                </form>

                <a href="{{ url('/dosen') }}">
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