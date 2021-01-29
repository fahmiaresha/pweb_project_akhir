@extends('layouts.template')
@section('title','Gallery Produk')
@section('head')
    <!-- Magnific popup -->
    <link rel="stylesheet" href="{{ url('vendors/lightbox/magnific-popup.css') }}" type="text/css">

    
@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Gallery</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Gallery</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Gallery Produk</li>
                </ol>
            </nav>
        </div>
        <p style="color:#e3bcba;" class="mt-10">Halaman ini menampilkan foto produk yang terdaftar...</p>
</div>



    <div class="page-header d-md-flex justify-content-between">
        <ul class="nav nav-pills gallery-filter justify-content-md-center mb-3 mb-md-0">
            <li class="nav-item">
                <a href="#" class="nav-link active" data-filter="*">All</a>
            </li>
            @foreach($kategori_produk as $kp)
            <li class="nav-item">
                <a href="#" class="nav-link" data-filter=".{{ $kp->ID_KATEGORI_PRODUK }} ">{{ $kp->NAMA_KATEGORI_PRODUK }}</a>
            </li>           
            @endforeach
        </ul>

        <!-- <div class="dropdown">
            <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Actions</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item">Upload</a>
                <a href="#" class="dropdown-item text-danger">Delete</a>
            </div>
        </div> -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="gallery-container row">
            @foreach($produk as $p)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 {{ $p->ID_KATEGORI_PRODUK }} mb-4">
                    <a href="{{ url('/foto_produk/'.$p->FOTO_PRODUK) }}" class="image-popup-gallery-item">
                        <div class="image-hover">
                            <img src="{{ url('/foto_produk/'.$p->FOTO_PRODUK) }}" class="rounded" alt="image">
                            <div class="image-hover-body rounded">
                                <div>
                                @foreach($kategori_produk as $kp)
                                    @if($kp->ID_KATEGORI_PRODUK==$p->ID_KATEGORI_PRODUK)
                                    <h5 class="mb-2">{{ $kp->NAMA_KATEGORI_PRODUK }} - {{$p->NAMA_PRODUK}}</h5>
                                    @endif
                                @endforeach
                                    <div><i class="fa fa-tag mr-2"></i>Rp. {{number_format($p->HARGA_JUAL_PELANGGAN_PRODUK)}}</div>
                                    <!-- <div><i class="fa fa-tag mr-2"></i>Rp. {{number_format($p->HARGA_JUAL_RESELLER_PRODUK)}}</div> -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    


@endsection

@section('script')
    <!-- Magnific popup -->
    <script src="{{ url('vendors/lightbox/jquery.magnific-popup.min.js') }}"></script>

    <!-- Isotope -->
    <script src="{{ url('vendors/jquery.isotope.min.js') }}"></script>

    <script src="{{ url('assets/js/examples/pages/gallery.js') }}"></script>

@endsection
