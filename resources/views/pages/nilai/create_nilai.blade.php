@extends('layout/layout_dashboard')

@section('konten')

<!-- Vertical Layout | With Floating Label -->

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    NILAI MATA KULIAH
                </h2>
                
            </div>
            <div class="body">
                <form method="POST" action="/nilai">
                    @csrf
                <div class="row clearfix">

                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="id_matkul" name="id_matkul" value="{{Session::get('id_matkul')}}" class="form-control" required>
                                <label class="form-label">Kode Mata Kuliah</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="nim" name="nim" class="form-control" value="{{Session::get('nim')}}" required>
                                <label class="form-label">NIM</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float ">
                            <div class="form-line">
                                <input type="text" id="angka" name="angka" class="form-control" required>
                                <label class="form-label">Nilai</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="tahun_ajaran" name="tahun_ajaran" class="form-control" required>
                                <label class="form-label">Tahun Ajaran</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="text-right">
                                <label class="form-label">Semester :</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-3 col-sm-1 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input name="semester" type="radio" class="with-gap" id="radio_1" value="GANJIL" />
                                <label for="radio_1">Ganjil</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-1 col-xs-6">
                        <div class="form-group form-float">
                            
                            <div class="form-line">
                                <input name="semester" type="radio" id="radio_2" class="with-gap" value="GENAP" />
                                <label for="radio_2">Genap</label>
                            </div>
                        </div>
                    </div>

                   
                </div>


                    <br>
                    <button type="button submit" class="btn btn-primary m-t-15 waves-effect form-control">Simpan</button>
                </form>

                <br>
                <a href="/dashboard">
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