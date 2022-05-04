@extends('layouts.template')
@section('title','Dashboard')
@section('head')
<!-- Datatable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

<!-- rangepicker -->
<link rel="stylesheet" href="vendors/datepicker/daterangepicker.css" type="text/css">

@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
    <div>
        <h3>Welcome back, {{Session::get('nama_user')}}.</h3>
        <p class="text-muted">Halaman ini merupakan halaman awal setelah berhasil login.</p>
    </div>
    <div class="mt-3 mt-md-0">
        <div class="btn btn-dark">
            <span> @php
                date_default_timezone_set('Asia/Jakarta');
                $hariIni = new DateTime();
                echo strftime('%A %d %B %Y, %H:%M', $hariIni->getTimestamp()) . '<br>';
                @endphp</span>
        </div>
    </div>
</div>
<img src="{{ url('assets/media/image/dashboard-2.png') }}" width="100%" alt="" >
@endsection
