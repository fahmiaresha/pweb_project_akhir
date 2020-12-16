@extends('layouts.template')
@section('title','Laporan Penjualan')
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
                    <li class="breadcrumb-item active" aria-current="page">Laporan Penjualan</li>
                </ol>
            </nav>
        </div>
    </div>
    

    <div class="card">
        <div class="card-body">
                <form method="post" action="{{ url('/search-laporan-penjualan') }}" id="form_cari">
                    @csrf
                    <label for="Nama">Tanggal Nota</label>
                    <input type="text" name="daterangepicker" class="demo-code-preview form-control mt-1" placeholder="Tanggal Nota" name="daterangepicker" id="daterangepicker" value="{{ old('daterangepicker') }}">
                    <p style="color:#e3bcba;" class="mt-2">*Pilih range tanggal laporan</p>

                   
                   
                                       
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="reset"  class="btn btn-danger mr-1 mt-2">Reset</button>
                                <button  type="submit" class="btn btn-primary mt-2">Tampilkan</button>
                            </div>
                        </div>
                </form>
        </div>
    </div>

    @if (session('sukses'))
            @php $x=session('sukses'); @endphp
            @php 
                $fromdate=session('fromDate'); 
                $todate=session('toDate'); 
            @endphp
    <div class="card">
        <div class="card-body">
    <center>
    <div class="coba mb-5"><strong> <h4>Laporan Penjualan</h4></strong></div>
    </strong>
    </center>
                <div class="form-row">

                <div class="form-group col-md-4">
                        
                <p><strong> Tanggal : </strong>  {{date('d-m-Y', strtotime($fromdate)) }} s/d
                    {{date('d-m-Y', strtotime($todate)) }}</p>  
                </div>
                <div class="form-group col-md-8 text-right">
                <a href="/pdf-laporan-penjualan/{{$fromdate}}/{{$todate}}" target="_blank" class="btn btn-outline-success ml-2"> <i class="fa fa-download mr-2"></i>Laporan</a>
                </div>

                </div>

                
               

            <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                        <th>Inovice</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Pelanggan</th>
                        <th>Kasir</th>
                        <th>Total Bayar</th>
                        </tr>
                    </thead>
                <tbody>
                @php 
                $total_penjualan_umum=0;
                $total_penjualan_reseller=0;
                $total_penjualan_fix=0;
                @endphp
                @foreach($x as $p)
                    <tr>
                    <td>INV-{{$p->ID_PENJUALAN}}</td>
                    <td> {{date('d-m-Y H:i:s', strtotime($p->TANGGAL_PENJUALAN)) }}</td>           
                    <td>
                        @foreach($kategori_pelanggan as $kp)
                        @if($p->KATEGORI_PELANGGAN_PENJUALAN==$kp->ID_KATEGORI_PELANGGAN)
                        {{$kp->NAMA_KATEGORI_PELANGGAN}}
                        @endif
                        @endforeach
                    </td>
                    <td>
                    @if($p->ID_PELANGGAN==null)
                    Umum
                    @else
                        @foreach($pelanggan as $pl)
                             @if($p->ID_PELANGGAN==$pl->ID_PELANGGAN)
                                {{$pl->NAMA_PELANGGAN}} - {{$pl->ALAMAT_PELANGGAN}}
                             @endif
                        @endforeach
                    @endif  
                    </td>
                    <td>Fahmi Aresha</td>
                    <td>Rp. {{ number_format($p->TOTAL_PENJUALAN)}}</td>
                    </tr>
                            @if($p->KATEGORI_PELANGGAN_PENJUALAN==1)
                                @php $total_penjualan_reseller += $p->TOTAL_PENJUALAN; @endphp
                            @endif
                            @if($p->KATEGORI_PELANGGAN_PENJUALAN==2)
                                @php $total_penjualan_umum += $p->TOTAL_PENJUALAN; @endphp
                            @endif
                @endforeach

                    @php $total_penjualan_fix=$total_penjualan_reseller + $total_penjualan_umum; @endphp
                </tbody>
                    <tr class="alert alert-info" role="alert">
                    <td  colspan="2" style="text-align:left;  border: none;"><strong><i class="fa fa-info-circle mr-2"></i>Penjualan Reseller</strong></td>
                        <td colspan="1" style="text-align:left;  border: none;">Rp. {{ number_format($total_penjualan_reseller)}} </td>
                        <td  colspan="2" style="text-align:left;  border: none;"><strong><i class="fa fa-info-circle mr-2"></i>Penjualan Non-Reseller</strong></td>
                        <td colspan="1" style="text-align:left;  border: none;">Rp. {{ number_format($total_penjualan_umum)}}</td>
                    </tr>
                   
                    
                        
                    <tr class="alert alert-success" role="alert">
                    <td colspan="5" style="text-align:left;  border: none;"><strong><i class="ti-check mr-2"></i>Total Penjualan</strong></td>
                     <td colspan="2" style="text-align:left;  border: none;">Rp. {{ number_format($total_penjualan_fix)}} </td>
                    </tr>
                </table>
                </div>
                

                <br>
                <!-- <center>
                <div style="height:auto; max-width:100%; cursor:pointer;">
		        <canvas id="myChart"></canvas>
	            </div>
                </center> -->
              
               
            </div>
            </div>
           
    </div>
    </div>
                

        @endif
@endsection

@section('script')
<script src="vendors/charts/chartjs/chart.min.js"></script>
<script src="assets/js/examples/charts/chartjs.js"></script>

<script>
$(document).ready(function (){
    $('#myTable').DataTable(); 
    $('.select2-example').select2();
    $('input[name="daterangepicker"]').daterangepicker({
    opens: 'left',
    locale: {
      format: 'DD-MM-YYYY'
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
</script>
@endif

@if(session('search_kosong'))
<script>
swal("Oops!","Data Tidak Ditemukan!","error");
</script>
@endif

@endsection

