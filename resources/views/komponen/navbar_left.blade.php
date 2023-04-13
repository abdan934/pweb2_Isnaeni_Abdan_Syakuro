        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{asset('images/user.png')}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                    <div class="email">{{$user->email}}</div>
                    <div class="email">{{$user->name}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/logout"><i class="material-icons">input</i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">NAVIGASI</li>
                    <li class="@if(isset($url_dashboard)){{{$url_dashboard}}} @endif">
                        <a href="/dashboard">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if ($role=='dosen')
                    
                    <li class="@if(isset($url_datanilai)){{{$url_datanilai}}} @endif">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Data Nilai</span>
                        </a>
                        <ul class="ml-menu">
                            {{-- <li >
                                <a href="{{ url('/nilai/create') }}">Isi Nilai</a>
                            </li> --}}
                            <li >
                                <a href="{{ url('/nilaimahasiswa') }}">Nilai</a>
                            </li>
                        </ul>
                    </li>
                    @elseif($role=='mahasiswa')
                    <li class="@if(isset($url_nilaipersem)){{{$url_nilaipersem}}} @endif">
                        <a href="{{ url('/nilaipersemester') }}">
                            <i class="material-icons">view_list</i>
                            <span>Nilai per Semester</span>
                        </a>
                    </li>
                    @else
                    <li class="@if(isset($url_data)){{{$url_data}}} @endif">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li >
                                <a href="{{ url('/matakuliah') }}">Data Mata Kuliah</a>
                            </li>
                            <li >
                                <a href="{{ url('/dosen') }}">Data Dosen</a>
                            </li>
                            <li >
                                <a href="{{ url('/mahasiswa') }}">Data Mahasiswa</a>
                            </li>
                            <li >
                                <a href="{{ url('/nilai') }}">Data Nilai</a>
                            </li>
                            <li >
                                <a href="{{ url('/datauser') }}">Data User</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    
                    
                   

                   
                   
                </ul>
            </div>
            <!-- #Menu -->
           
        </aside>
        <!-- #END# Left Sidebar -->