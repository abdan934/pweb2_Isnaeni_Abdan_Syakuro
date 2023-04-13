@extends('layout/layout_dashboard')

@section('konten')

<div class="container-fluid">
    <div class="block-header">
        <h2>Dashboard</h2>
    </div>
    <!-- Body Copy -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                
                </div>
                <div class="body">
                <div class="gbr-dashboard"> 
                    <p class="lead">
                        <div class="image" style="justify-contenct: center;">
                            <img src="images/user.png" width="48" height="48" alt="User" />
                        </div>
                    </p>
                </div>

                    <p class="tangan">
                        <span class="wave">
                            👋
                        </span>
                    </p>
                    <div class="ucapan">
                    <p>
                       <h1>Hi, {{$user->name}} <p>Selamat Datang di Online SIM PNC</p></h1>
                       <h1></h1>
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Body Copy -->
    


</div>
@endsection