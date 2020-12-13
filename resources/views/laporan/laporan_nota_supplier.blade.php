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
                <form method="post" action="{{ url('/search-nota-supplier') }}" id="form_cari">
                    @csrf
                    <label for="Nama">Tanggal Nota</label>
                    <input type="text" name="daterangepicker" class="demo-code-preview form-control mt-1" placeholder="Tanggal Nota" name="daterangepicker" id="daterangepicker" value="{{ old('daterangepicker') }}">
                    <p style="color:#e3bcba;" class="mt-2">*Pilih range tanggal laporan</p>

                    <label for="Kategori">Supplier</label>
                        <select name="supplier" id="supplier" class="select2-example">
                        <option selected="true" value="">All</option>
                        @foreach($supplier as $sp)
                        <option value="{{ $sp->ID_SUPPLIER }}" required>{{ $sp->NAMA_SUPPLIER }}</option>
                        @endforeach
                       </select>
                       <p style="color:#e3bcba;" class="mt-2">*Kosongkan jika ingin menampilkan keseluruhan</p>
                    <button  type="submit" class="btn btn-primary mt-3">Cari</button>
                </form>

                <!-- <div class="container" id="keranjang_kosong">
                <center>
               <h5 style="color:#e3bcba">Keranjang Kosong , Silahkan Tambahkan Produk...</h5>
               <br>
                </center>
                </div> -->
        </div>
    </div>
        @if (session('sukses'))
            @php $x=session('sukses'); @endphp
            @php 
                $fromdate=session('fromDate'); 
                $todate=session('toDate'); 
                $input_supplier=session('input_supplier');
                if($input_supplier==null){
                    $input_supplier='kosong';  
                }
            @endphp
    <div class="card">
        <div class="card-body">
    <center>
    <div class="coba mb-5"><strong> <h4>Laporan Nota Supplier</h4></strong></div>
    </strong>
    </center>

                <div class="form-row">

                <div class="form-group col-md-4">
                        <strong>
                <p>Tanggal : {{date('d-m-Y', strtotime($fromdate)) }} s/d
                    {{date('d-m-Y', strtotime($todate)) }}</p>  </strong>
                </div>
                <div class="form-group col-md-8 text-right">
                <a href="/pdf-nota-supplier/{{$fromdate}}/{{$todate}}/{{$input_supplier}}" target="_blank" class="btn btn-outline-success ml-2"> <i class="fa fa-download mr-2"></i>Laporan</a>
                </div>

                </div>
           
               
             
            
        
            <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                      
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Nomor Nota</th> 
                        <th>Tanggal Nota</th>
                        <th>Total Bayar</th>
                        </tr>
                    </thead>
                <tbody>
            @php 
            $status_sudah_dibayar=0;
            $status_belum_dibayar=0;
            @endphp
                @foreach($x as $y)
                        <tr>
                        @foreach($supplier as $s)
                        @if($s->ID_SUPPLIER==$y->ID_SUPPLIER)
                        <td> {{$s->NAMA_SUPPLIER}} - {{$s->ALAMAT_SUPPLIER}}                </td>
                        @endif
                    @endforeach
                       
                        <td>
                        @if($y->STATUS_NOTA_SUPPLIER==1)
                         Lunas
                        @else
                         Belum Lunas
                        @endif
                        </td>
                        <td> {{$y->NOMOR_NOTA_SUPPLIER}}  </td>
                        
                        <td>  {{date('d-m-Y', strtotime($y->TANGGAL_NOTA_DATANG)) }}  </td>
                   
                        <td> Rp. {{ number_format($y->TOTAL_BAYAR_NOTA_SUPPLIER)}}    </td>
                        </tr>
                    @if($y->STATUS_NOTA_SUPPLIER==1)
                        @php $status_sudah_dibayar += $y->TOTAL_BAYAR_NOTA_SUPPLIER @endphp
                    @else
                        @php $status_belum_dibayar += $y->TOTAL_BAYAR_NOTA_SUPPLIER @endphp
                    @endif
                @endforeach
                       
                </tbody>
               
                         <tr>
                         <td  colspan="1" class="alert alert-danger" style="text-align:left; border: none;"><strong><i class="ti-alert mr-2"></i>Nota Belum Lunas</strong></td>
                            <td  colspan="2" class="alert alert-danger" style="text-align:right; border: none;">Rp. {{ number_format($status_belum_dibayar)}} </td>

                            <td colspan="1"class="alert alert-success" style="text-align:left; border: none;"><strong><i class="ti-check mr-2"></i>Nota Lunas</strong></td>
                            <td  colspan="2" class="alert alert-success" style="text-align:right; border: none;">Rp. {{ number_format($status_sudah_dibayar)}} </td>        
                        </tr> 
                </table>
                </div>

              
            </div>
            </div>
    </div>
    </div>
        @endif
@endsection

@section('script')

<script>
$(document).ready(function (){
    $('#myTable').DataTable(); 
    $('.select2-example').select2();
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

@if (session('sukses'))
<script>
swal("Success!","Laporan Berhasil Dibuat!","success");
// $('#form_cari').hide();
</script>
@endif

@if(session('search_kosong'))
<script>
swal("Oops!","Data Tidak Ditemukan!","error");
</script>
@endif

@endsection