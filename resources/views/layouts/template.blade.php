<!doctype html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('assets/media/image/favicon.ico') }}"/>

    <!-- Main css -->
    <link rel="stylesheet" href="{{ url('vendors/bundle.css') }}" type="text/css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
    .badge-notif {
        position:relative;
        }

        .badge-notif[data-badge]:after {
                content:attr(data-badge);
                position:absolute;
                top:-10px;
                right:-10px;
                font-size:.7em;
                background:#e53935;
                color:white;
                width:18px;
                height:18px;
                text-align:center;
                line-height:18px;
                border-radius: 50%;
        }
    </style>
@yield('head')

<!-- App css -->
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body  class="dark scrollable-layout   " onclick="gerak()">
<!-- horizontal-navigation -->
<!-- Preloader -->
<div class="preloader">
    <div class="preloader-icon"></div>
    <span>Loading...</span>
</div>
<!-- ./ Preloader -->

<!-- HEADER group -->
<div class="sidebar-group">


    

</div>
<!-- ./ header group -->

<!-- Layout wrapper -->
<div class="layout-wrapper">

    <!-- Header -->
    <div class="header d-print-none">
        <div class="header-container">
            <div class="header-left">
                <div class="navigation-toggler">
                    <a href="#" data-action="navigation-toggler">
                        <i data-feather="menu"></i>
                    </a>
                </div>

                <div class="header-logo">
                    <a href="{{ url('/home') }}">
                        <!-- <img class="logo" src="{{ url('assets/media/image/logo.png') }}" alt="logo"> -->
                        <img class="logo" src="{{ url('assets/media/image/favicon.ico') }}" alt="logo">
                        <h4 class="logo mt-3 ml-2" style="color:white">Toko Bagus</h4>
                    </a>
                </div>
            </div>

            <div class="header-body">
                <div class="header-body-left">
                    <ul class="navbar-nav">
                        <li class="nav-item mr-3">
                            <div class="header-search-form">
                                <form>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn">
                                                <i data-feather="search"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn header-search-close-btn">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    
                    </ul>
                </div>

                <div class="header-body-right">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link mobile-header-search-btn" title="Search">
                                <i data-feather="search"></i>
                            </a>
                        </li>

                        

                        <li class="nav-item dropdown d-none d-md-block">
                            <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                                <i class="maximize" data-feather="maximize"></i>
                                <i class="minimize" data-feather="minimize"></i>
                            </a>
                        </li>

                        <?php
                            $produk = \DB::select("SELECT * from produk where STOK_PRODUK < 10");
                            $kategori_produk = \DB::select("SELECT * from kategori_produk");
                        ?>

                        <li class="nav-item dropdown mr-3">
                            <a href="#" class="badge-notif" data-badge="{{ count($produk) }}"  title="Notifications" data-toggle="dropdown">
                                <i data-feather="bell"></i>
                                 <!-- <span> </span> -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big ">
                                <div
                                    class="border-bottom px-4 py-3 text-center d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Notifications</h5>
                                </div>
                                <div class="dropdown-scroll">
                                @foreach($produk as $p)
                                
                                    <ul class="list-group list-group-flush">
                                        <li class="px-4 py-2 text-center small text-muted bg-light">Stok Produk Hampir Habis</li>
                                        <li class="px-4 py-3 list-group-item">
                                            <a href="#" class="d-flex align-items-center hide-show-toggler">
                                                <div class="flex-shrink-0">
                                                    <figure class="avatar mr-3">
                                                        <span class="avatar-title bg-warning-bright text-warning rounded-circle">
                                                            <i class="ti-alert"></i>
                                                        </span>
                                                    </figure>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-0 line-height-20 d-flex justify-content-between">
                                                    @foreach($kategori_produk as $kp)
                                                        @if($p->ID_KATEGORI_PRODUK==$kp->ID_KATEGORI_PRODUK)
                                                        {{$kp->NAMA_KATEGORI_PRODUK}} - {{$p->NAMA_PRODUK}}
                                                        @endif    
                                                    @endforeach
                                                        
                                                        <i title="Mark as unread" data-toggle="tooltip"
                                                           class="hide-show-toggler-item fa fa-check font-size-11"></i>
                                                    </p>
                                                    <span class="text-muted small">Stok Sisa {{$p->STOK_PRODUK}}</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                @endforeach
                                </div>

                                <div class="px-4 py-3 text-right border-top">
                                    <ul class="list-inline small">
                                        <li class="list-inline-item mb-0">
                                            <a href="#">Mark All Read</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                

                        <li class="nav-item dropdown">
                        <figure class="avatar avatar-sm">
                            <img src="{{ url('assets/media/image/user/man_avatar3.jpg') }}"
                                         class="rounded-circle"
                                         alt="avatar">
                                </figure>
                                <span class="ml-2 d-sm-inline d-none">{{Session::get('nama_user')}}</span>
                            </a>
                            <!-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div class="text-center py-4">
                                    <figure class="avatar avatar-lg mb-3 border-0">
                                        <img src="{{Session::get('foto')}}"
                                             class="rounded-circle" alt="image">
                                    </figure>
                                    <h5 class="text-center">{{Session::get('nama')}}</h5>
                                    <h7 class="text-center">{{Session::get('id')}}</h5>
                                    <div class="div">
                                    <h7 class="text-center">{{Session::get('email')}}</h5>
                                    </div>
                                    
                                </div>
                                <div class="list-group">
                                    <a href="/logout" class="list-group-item" >Sign Out!</a>
                                </div>
                                <div class="p-4">
                                  
                                </div>
                            </div> -->
                        </li>

                        
                    </ul>
                </div>
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item header-toggler">
                    <a href="#" class="nav-link">
                        <i data-feather="arrow-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ./ Header -->

     <!-- SIDEBARR -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- begin::navigation -->
        <div class="navigation">
            <div class="navigation-header">
                <span>Navigation</span>
                <a href="#">
                    <i class="ti-close"></i>
                </a>
            </div>
            <div class="navigation-menu-body">
                <ul>
                    <li>
                        <a @if(request()->segment(1) =='home') class="active" @endif href="{{ route('home') }}" >
                   
                    <span class="nav-link-icon">
                    <i class="fa fa-tachometer-alt"></i>
                    </span>
                    
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @if(auth()->user()->ID_JABATAN=="1")
                    <li>
                        <a @if(request()->segment(1) =='pegawai') class="active" @endif href="{{ route('pegawai') }}" >
                    <span class="nav-link-icon">
                    <i class="fas fa-user-check" ></i>
                    </span>
                            <span>Pegawai</span>
                        </a>
                    </li>
                    @endif
                    

                   
      

                    <li>
                        <a href="#">
                        <span class="nav-link-icon" >
                    <i class="fa fa-users"></i>
                    </span>
                            <span>Pelanggan</span>
                        </a>
                        <ul>
                             <li>
                            <a @if(request()->segment(1) == 'data-pelanggan') class="active" @endif href="{{ route('data-pelanggan') }}">Data Pelanggan</a>
                            </li>

                            <li>
                            <a @if(request()->segment(1) == 'kategori-pelanggan') class="active" @endif href="{{ route('kategori-pelanggan') }}">Kategori Pelanggan</a>
                            </li>

                            <li>
                            <a @if(request()->segment(1) == 'service-pelanggan') class="active" @endif href="{{ route('service-pelanggan') }}">Service Pelanggan</a>
                            </li>
                            
                          

                            <li>
                            <a @if(request()->segment(1) == 'pesanan-pelanggan') class="active" @endif href="{{ route('pesanan-pelanggan') }}">Pesanan Pelanggan</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#">
                        <span class="nav-link-icon" >
                        <i class="fa fa-truck"></i>
                    </span>
                            <span >Supplier</span>
                        </a>
                        <ul>
                             <li>
                            <a @if(request()->segment(1) == 'data-supplier') class="active" @endif href="{{ route('data-supplier') }}">Data Supplier</a>
                            </li>

                            <li>
                            <a @if(request()->segment(1) == 'pesan-supplier') class="active" @endif href="{{ route('pesan-supplier') }}">Pesan Supplier</a>
                            </li>

                            <li>
                            <a @if(request()->segment(1) == 'nota-supplier') class="active" @endif href="{{ route('nota-supplier') }}">Nota Supplier</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                        <span class="nav-link-icon" >
                        <i class="fa fa-briefcase"></i>
                    </span>
                            <span>Produk</span>
                        </a>
                        <ul>
                             <li>
                            <a @if(request()->segment(1) == 'data-produk') class="active" @endif href="{{ route('data-produk') }}">Data Produk</a>
                            </li>

                            <li>
                            <a @if(request()->segment(1) == 'kategori-produk') class="active" @endif href="{{ route('kategori-produk') }}">Kategori Produk</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#">
                        <span class="nav-link-icon">
                    <i class="fa fa-cart-plus"></i>
                    </span>
                            <span>Penjualan</span>
                        </a>
                        <ul>
                            <li>
                            <a @if(request()->segment(1) == 'data-penjualan') class="active" @endif href="{{ route('data-penjualan') }}">Data Penjualan</a>
                            </li>

                             <li>
                            <a @if(request()->segment(1) == 'point-of-sales') class="active" @endif href="{{ route('point-of-sales') }}">Point Of Sales</a>
                            </li>
                        </ul>
                    </li>

                   

                    @if(auth()->user()->ID_JABATAN=="1")
                    <li>
                        <a href="#">
                        <span class="nav-link-icon">
                    <i class="fa fa-bar-chart"></i>
                    </span>
                            <span >Laporan</span>
                        </a>
                        <ul>
                            <li>
                            <a @if(request()->segment(1) == 'laporan-penjualan') class="active" @endif href="{{ route('laporan-penjualan') }}">Laporan Penjualan</a>
                            </li>

                             <li>
                            <a @if(request()->segment(1) == 'laporan-nota-supplier') class="active" @endif href="{{ route('laporan-nota-supplier') }}">Laporan Nota Supplier</a>
                            </li>
                        </ul>
                    </li>
                    @endif


                    <!-- <li>
                        <a @if(request()->segment(1) =='whatsapp') class="active" @endif href="{{ route('whatsapp') }}" >
                    <span class="nav-link-icon">
                    <i class="fa fa-whatsapp"></i>
                    </span>
                            <span>Whatsapp</span>
                        </a>
                    </li> -->


                    
                    

                    <li>
                        <a href="#">
                        <span class="nav-link-icon">
                        <i class="fa fa-cog"></i>
                        <!-- <i class="fa fa-user-cog"></i> -->
                    </span>
                            <span >Settings</span>
                        </a>
                        <ul>

                            

                            <li>
                            <a @if(request()->segment(1) == 'profile') class="active" @endif href="{{ route('profile') }}">Profile</a>
                            </li>


                            <li>
                            <a @if(request()->segment(1) == 'logout') class="active" @endif href="{{ route('logout') }}">Logout</a>
                            </li>

                            

                            
                        </ul>
                    </li>

                    <!-- <li>
                        <a @if(request()->segment(1) =='user-manual') class="active" @endif href="{{ route('user-manual') }}" >
                    <span class="nav-link-icon">
                    <i class="fa fa-download"></i>
                    </span>
                            <span>User Manual</span>
                        </a>
                    </li> -->

                  
                </ul>
            </div>
        </div>
        <!-- end::navigation -->
        <!-- end::SIDEBAR -->

        
        <!-- Content body -->
        <div class="content-body">

            <!-- KONTEN -->
            <div class="content @yield('parentClassName')" >
                @yield('content')
            </div>
            <!-- .KONTEN -->

            <!-- Footer -->
            <footer class="content-footer">
                <div>© {{ date('Y') }} - Toko Bagus . All rights reserved</div>
                <!-- <div>
                    <nav class="nav">
                        <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
                        <a href="#" class="nav-link">Change Log</a>
                        <a href="#" class="nav-link">Get Help</a>
                    </nav> -->
                </div>
            </footer>
            <!-- ./ Footer -->

            <!-- Notifikasi-logout -->
            <footer>
            <div class="modal fade" id="logout_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div style="width:100%;height:100%;margin: 0px; padding:0px">
                                <div style="width:25%;margin: 0px; padding:0px;float:left;">
                                    <i class="fa fa-warning" style="font-size: 140px;color:#da4f49"></i>
                                </div>
                                <div style="width:70%;margin: 0px; padding:0px;float:right;padding-top: 10px;padding-left: 3%;">
                                    <h4>Your session is about to expire!</h4>
                                    <p style="font-size: 15px;">You will be logged out in <span id="timer" style="display: inline;font-size: 30px;font-style: bold">10</span> seconds.</p>              
                                    <p style="font-size: 15px;">Do you want to stay signed in?</p>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div style="margin-left: 30%;margin-bottom: 20px;margin-top: 20px;">
                            <a href="javascript:;" onclick="resetTimer()" class="btn btn-primary" aria-hidden="true">Yes, Keep me signed in</a>
                            <a href="javascript:;" onclick="chooseOut()" class="btn btn-danger" id="alertbox" aria-hidden="true">No, Sign me out</a>
                        </div>
                    </div>
                </div>
            </div>
            </footer>
             <!-- Notifikasi-logout -->

        </div>
        <!-- ./ Content body -->
    </div>
    <!-- ./ Content wrapper -->
</div>
<!-- ./ Layout wrapper -->

<!-- Main scripts -->
<script src="{{ url('vendors/bundle.js') }}"></script>

@yield('script')

<!-- App scripts -->
<script src="{{ url('assets/js/app.min.js') }}"></script>

<script>

        var c = 0; max_count = 10; logout = true;
        startTimer();

        function startTimer(){
            setTimeout(function(){
                logout = true;
                c = 0; 
                max_count = 10;
                $('#timer').html(max_count);
                $('#logout_popup').modal('show');
                startCount();
            }, 30*60*1000); //, 30 menit=30*60*1000, 
        }

        function resetTimer(){
            logout = false;
            $('#logout_popup').modal('hide');
            startTimer();
        }

        function chooseOut(){
            logout = false;
            $('#logout_popup').modal('hide');
            console.log('Your time is expired');
            //pindah halaman-login
            window.location = "/logout";
        }

        function timedCount() {
            c = c + 1;
            if(c<=10){
            // console.log('nilai c');
            // console.log(c);
            // console.log('nilai remaining time');
            remaining_time = max_count - c;
            // console.log(remaining_time);
                if( remaining_time == 0 && logout ){
                    $('#logout_popup').modal('hide');
                    //location.href = $('#logout_url').val();
                    chooseOut();
                }
                else{
                    $('#timer').html(remaining_time);
                    t = setTimeout(function(){timedCount()}, 1000);
                    }
            }
            else{
                $('#logout_popup').modal('hide');
                resetTimer(); 
            }
    }

        function startCount() {
           timedCount();
        }
        
        function gerak(){
            $('#logout_popup').modal('hide');
            console.log('masuk function gerak');
            resetTimer(); 
        }

        const x = document.getElementsByClassName('post0');
            for(let i=0;i<x.length;i++){
            x[i].addEventListener('click',function(){
                x[i].submit();
            });
        }
    </script>


</body>
</html>
