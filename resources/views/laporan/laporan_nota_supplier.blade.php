@extends('layouts.template')
@section('title','Laporan Nota Supplier')
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
            <h3>Laporan</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Laporan</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan Nota Supplier</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <form method="post" action="{{ url('/search-nota-supplier') }}">
                    @csrf
                    <label for="Nama">Tanggal</label>
                    <div class="form-row">
                    <div class="form-group col-md-5">
                    <input type="text" name="daterangepicker" class="demo-code-preview form-control mt-1" placeholder="Tanggal Nota" name="daterangepicker" id="daterangepicker" value="{{ old('daterangepicker') }}">
                    </div>
                    <div class="form-group col-md-3 col-sm-12 ml-1 mt-2">
                    <button  type="submit" class="btn btn-primary ">Tampil</button>
                    <!-- btn-rounded -->
                    </div>
                    </div>
                </form>

                <!-- <div class="container" id="keranjang_kosong">
                <center>
               <h5 style="color:#e3bcba">Keranjang Kosong , Silahkan Tambahkan Produk...</h5>
               <br>
                </center>
                </div> -->

            </div>
        </div>
    </div>

    @if(session('search_sukses'))
        {{$query}}
    @endif
@endsection

@section('script')

<script>
$(document).ready(function (){
    $('#myTable').DataTable(); 

    $('input[name="daterangepicker"]').daterangepicker({
    opens: 'left',
    locale: {
      format: 'YYYY-MM-DD'
    },
    // }, function (start, end, label) {
    //     swal("Tanggal yang dipilih", start.format('DD/MM/YYYY') + ' Sampai ' + end.format('DD/MM/YYYY'), "info")
    });

});
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>
<script src="vendors/datepicker/daterangepicker.js"></script>

@if(session('search_sukses'))
<script>
swal("Success!","Data Nota Supplier Ditemukan!","success");
</script>
@endif

@if(session('search_kosong'))
<script>
swal("Oops!","Data Nota Supplier Tidak Ditemukan!","error");
</script>
@endif

@endsection