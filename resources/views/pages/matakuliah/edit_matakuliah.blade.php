@extends('layout/layout_dashboard')

@section('konten')

<!-- Vertical Layout | With Floating Label -->

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    MATA KULIAH
                </h2>
                
            </div>
            <div class="body">
                <form method="POST" action="{{'/matakuliah/'.$data->id_matkul}}">
                    @csrf
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="id_matkul" name="id_matkul" value="{{$data->nim}}" class="form-control" required>
                                <label class="form-label">Kode Mata Kuliah</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="nidn" name="nidn" class="form-control" required>
                                <label class="form-label">NIDN</label>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="nama_matkul" name="nama_matkul" class="form-control" required>
                            <label class="form-label">Nama Mata Kuliah</label>
                        </div>
                    </div>
                  

                    <br>
                    <button type="button submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Vertical Layout | With Floating Label -->
    


</div>
@endsection