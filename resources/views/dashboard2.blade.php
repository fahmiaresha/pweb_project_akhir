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
<!-- hitung nota supplier lunas atau belum lunas -->
@php 
    $status_sudah_dibayar=0;
    $status_belum_dibayar=0;
@endphp
    @foreach($nota_supplier as $y)
        @if($y->STATUS_NOTA_SUPPLIER==1)
            @php $status_sudah_dibayar += $y->TOTAL_BAYAR_NOTA_SUPPLIER; @endphp
        @else
            @php $status_belum_dibayar += $y->TOTAL_BAYAR_NOTA_SUPPLIER; @endphp
        @endif
    @endforeach   

<!-- hitung laporan penjualan perhari -->    
@php 
    $total_penjualan_perhari=0;
@endphp      
    @foreach($laporan_penjualan_perhari as $lpr) 
        @php $total_penjualan_perhari += $lpr->TOTAL_PENJUALAN; @endphp
    @endforeach   

<!-- hitung laporan penjualan perbulan -->
@php 
    $total_penjualan_perbulan=0;
@endphp  
    @foreach($laporan_penjualan_perbulan as $lprb) 
        @php $total_penjualan_perbulan += $lprb->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan pertahun -->
@php 
    $total_penjualan_pertahun=0;
@endphp  
    @foreach($laporan_penjualan_pertahun as $lprt) 
        @php $total_penjualan_pertahun += $lprt->TOTAL_PENJUALAN; @endphp
    @endforeach     

<!-- hitung laporan penjualan bulan januari -->
@php $total_penjualan_januari=0; @endphp
    @foreach($laporan_penjualan_januari as $lpj)
        @php $total_penjualan_januari += $lpj->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan februari -->
@php $total_penjualan_februari=0; @endphp
    @foreach($laporan_penjualan_februari as $lpf)
        @php $total_penjualan_februari += $lpf->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan maret -->
@php $total_penjualan_maret=0; @endphp
    @foreach($laporan_penjualan_maret as $lpm)
        @php $total_penjualan_maret += $lpm->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan april -->
@php $total_penjualan_april=0; @endphp
    @foreach($laporan_penjualan_april as $lpa)
        @php $total_penjualan_april += $lpa->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan mei -->
@php $total_penjualan_mei=0; @endphp
    @foreach($laporan_penjualan_mei as $lpm)
        @php $total_penjualan_mei += $lpm->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan juni -->
@php $total_penjualan_juni=0; @endphp
    @foreach($laporan_penjualan_juni as $lpj)
        @php $total_penjualan_juni += $lpj->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan juli -->
@php $total_penjualan_juli=0; @endphp
    @foreach($laporan_penjualan_juli as $lpj)
        @php $total_penjualan_juli += $lpj->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan agustus -->
@php $total_penjualan_agustus=0; @endphp
    @foreach($laporan_penjualan_agustus as $lpa)
        @php $total_penjualan_agustus += $lpa->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan september -->
@php $total_penjualan_september=0; @endphp
    @foreach($laporan_penjualan_september as $lps)
        @php $total_penjualan_september += $lps->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan oktober -->
@php $total_penjualan_oktober=0; @endphp
    @foreach($laporan_penjualan_oktober as $lpo)
        @php $total_penjualan_oktober += $lpo->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan november -->
@php $total_penjualan_november=0; @endphp
    @foreach($laporan_penjualan_november as $lpn)
        @php $total_penjualan_november += $lpn->TOTAL_PENJUALAN; @endphp
    @endforeach

<!-- hitung laporan penjualan bulan desember -->
@php $total_penjualan_desember=0; @endphp
    @foreach($laporan_penjualan_desember as $lpd)
        @php $total_penjualan_desember += $lpd->TOTAL_PENJUALAN; @endphp
    @endforeach
              
<div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Welcome back, {{Session::get('nama_user')}}</h3>
            @if(auth()->user()->ID_JABATAN=="1")
            <p class="text-muted">Halaman ini menunjukkan ringkasan tahunan penjualan dan nota supplier.</p>
            @endif

            @if(auth()->user()->ID_JABATAN=="2")
            <p class="text-muted">Halaman ini menunjukkan ringkasan penjualan produk.</p>
            @endif
        </div>
        <div class="mt-3 mt-md-0">
            <div class="btn btn-outline-light">
                <span> @php
            date_default_timezone_set('Asia/Jakarta');
            $hariIni = new DateTime();
            echo strftime('%A %d %B %Y, %H:%M', $hariIni->getTimestamp()) . '<br>';
            @endphp</span>
            </div>
        </div>
</div>

<div class="row">
        <div class="col-md-3">
        <a href="/data-produk">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title"> {{$total_produk}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Produk</div>
                </div>
            </div>
            </a>
        </div>
        

        <div class="col-md-3">
        <a href="/kategori-produk">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title"> {{$total_kategori_produk}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Kategori Produk</div>
                </div>
            </div>
        </a>
        </div>

        <div class="col-md-3">
        <a href="/service-pelanggan">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title"> {{$total_service}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Service</div>
                </div>
            </div>
        </a>
        </div>

        <div class="col-md-3">
        <a href="/data-penjualan">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title"> {{$total_penjualan}} </h6>
                    </div>
                    <div class="coba" style="margin-top:-10px;">Jumlah Transaksi</div>
                </div>
            </div>
        </a>
        </div>
</div>

<!-- hak akses owner -->
@if(auth()->user()->ID_JABATAN=="1")
<div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title mb-2">Penjualan </h6>
                    </div>
                    <div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>Hari</h5>
                                    <div>Total penjualan</div>
                                </div>
                                <h3 class="text-warning mb-0">Rp. {{ number_format($total_penjualan_perhari)}}</h3>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>Bulan</h5>
                                    <div>Total penjualan</div>
                                </div>
                                <div>
                                    <h3 class="text-info mb-0">Rp. {{ number_format($total_penjualan_perbulan)}}</h3>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>Tahun</h5>
                                    <div>Total penjualan</div>
                                </div>
                                <div>
                                    <h3 class="text-success mb-0">Rp. {{ number_format($total_penjualan_pertahun)}}</h3>
                                </div>
                            </div>
                            <div class="mt-3">
                                    <a href="/pdf-laporan-penjualan/{{$tgl_awal_laporan_tahunan}}/{{$tgl_akhir_laporan_tahunan}}/kosong" target="_blank" class="btn btn-primary pull-right">Report Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title mb-2">Supplier </h6>
                    </div>
                    <div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>Lunas</h5>
                                    <div>Total nota</div>
                                </div>
                                    
                                <h3 class="text-success mb-0">Rp. {{ number_format($status_sudah_dibayar)}}</h3>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>Belum Lunas</h5>
                                    <div>Total nota</div>
                                </div>
                                <div>
                                    <h3 class="text-danger mb-0">Rp. {{ number_format($status_belum_dibayar)}}</h3>
                                </div>
                            </div>
                            <div class="mt-3">
                                    <a href="/pdf-nota-supplier/{{$tgl_awal_laporan_tahunan}}/{{$tgl_akhir_laporan_tahunan}}/kosong" target="_blank" class="btn btn-warning pull-right">Report Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endif




<!-- hak akses admin -->
<div class="row">
<div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title mb-2">Produk terjual</h6>
                    </div>
                    <div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>Hari</h5>
                                    <div>Total penjualan</div>
                                </div>
                                <h3 class="text-warning mb-0">{{$produk_terjual_hari}}</h3>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>Bulan</h5>
                                    <div>Total penjualan</div>
                                </div>
                                <div>
                                    <h3 class="text-info mb-0">{{$produk_terjual_bulanan}}</h3>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <h5>Tahun</h5>
                                    <div>Total penjualan</div>
                                </div>
                                <div>
                                    <h3 class="text-success mb-0">{{$produk_terjual_tahunan}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            $produk = \DB::select("SELECT * from produk where STOK_PRODUK < 10");
            $kategori_produk = \DB::select("SELECT * from kategori_produk");
            $suppier = \DB::select("SELECT * from supplier");
            $catatan_order_supplier = \DB::select("SELECT * from catatan_order_supplier");
        ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title mb-2">Supplier</h6>
                    </div>
                    <div>
                        <div class="list-group list-group-flush">
                                @php
                                $pesanan_selesai=0;
                                $pesanan_blm_selesai=0;
                                @endphp
                            @foreach($catatan_order_supplier as $cos)
                                @if($cos->STATUS_ORDER_SUPPLIER==1)
                                    @php $pesanan_selesai++; @endphp
                                @else
                                    @php $pesanan_blm_selesai++; @endphp
                                @endif
                            @endforeach
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <!-- <h5>Hari</h5> -->
                                    <div>Pesanan Selesai</div>
                                </div>
                                <h3 class="text-warning mb-0">@php echo $pesanan_selesai; @endphp</h3>
                            </div>

                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <!-- <h5>Bulan</h5> -->
                                    <div>Pesanan Belum Selesai</div>
                                </div>
                                <div>
                                    <h3 class="text-success mb-0">@php echo $pesanan_blm_selesai; @endphp</h3>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title mb-2">Stok</h6>
                    </div>
                    <div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <div>Produk hampir habis</div>
                                    <!-- <div>Total penjualan</div> -->
                                </div>
                                <h3 class="text-danger mb-0">{{ count($produk) }}</h3>
                            </div>
                        </div>
                        <div class="mt-3">
                                   <button class="btn btn-primary pull-right" onclick="show_detail()">Detail Produk</button>
                            </div>
                    </div>
                </div>
            </div>

        </div>

       
</div>

@if(auth()->user()->ID_JABATAN=="1")
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title mb-2">Penjualan</h6>
                    </div>
                    <div style="height:auto; max-width:100%; cursor:pointer;">
                            <canvas id="penjualan"></canvas>
                            </div>
                </div>
            </div>
        </div>
</div>
@endif

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title mb-2">Produk</h6>
                    </div>
                    <div style="height:auto; max-width:100%; cursor:pointer;">
                            <canvas id="produk"></canvas>
                            </div>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="detail_produk_hampir_habis" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Produk hampir habis</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="ti-close"></i>
            </button>
          </div>
          <div class="modal-body">
          <div class="table-responsive">
          <table class="table table-active table-hover" id="myTable">
                        <thead>
                        <tr>
                        <center>
                        
                          <th>#</th>
                          <th>Supplier</th>
                          <th>Kategori</th>
                          <th>Produk</th>
                          <th>Stok</th>
                          </center>
                        </tr>
                        </thead>
                        <tr>
                        
                        @foreach($produk as $p)
                        <td>{{$loop->iteration}}</td>
                            @foreach($suppier as $s)
                                @if($p->ID_SUPPLIER==$s->ID_SUPPLIER)
                                    <td>{{$s->NAMA_SUPPLIER}} - {{$s->ALAMAT_SUPPLIER}}</td>
                                @endif
                            @endforeach
                        
                            @foreach($kategori_produk as $kp)
                                @if($p->ID_KATEGORI_PRODUK==$kp->ID_KATEGORI_PRODUK)
                                <td>{{$kp->NAMA_KATEGORI_PRODUK}}</td>
                                <td>{{$p->NAMA_PRODUK}}</td>
                                @endif    
                                
                            @endforeach
                            
                           
                           
                            <td style="text-align:center;">{{$p->STOK_PRODUK}}</td>
                            
                        </tr>
                        @endforeach
                        </table>
                        <br>
          </div>
          </div>
         
        </div>
      </div>
    </div>
@endsection

@section('script')
<script>
    function show_detail(){
        $('#detail_produk_hampir_habis').modal('show');
    }

$(document).ready(function (){
    $('#myTable').DataTable();
});

</script>

<script src="vendors/charts/chartjs/chart.min.js"></script>
<script src="assets/js/examples/charts/chartjs.js"></script>
<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>
<script src="vendors/datepicker/daterangepicker.js"></script>

  <!-- Dashboard scripts -->
  <script src="{{ url('assets/js/examples/pages/dashboard.js') }}"></script>

   <!-- Apex chart -->
   <script src="{{ url('/vendors/charts/apex/apexcharts.min.js') }}"></script>

<script>
var ctx = document.getElementById("penjualan").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				    labels: ["Januari", "Febuari" , "Maret" , "April" , "Mei" , "Juni" , "Juli" , "Agustus" , "September" , "Oktober" , "November" , "Desember"],
				datasets: [{
					label: 'Grafik Penjualan',
					data: [
                        <?php echo $total_penjualan_januari; ?>,
                        <?php echo $total_penjualan_februari; ?>,
                        <?php echo $total_penjualan_maret; ?>,
                        <?php echo $total_penjualan_april; ?>,
                        <?php echo $total_penjualan_mei; ?>,
                        <?php echo $total_penjualan_juni; ?>,
                        <?php echo $total_penjualan_juli; ?>,
                        <?php echo $total_penjualan_agustus; ?>,
                        <?php echo $total_penjualan_september; ?>,
                        <?php echo $total_penjualan_oktober; ?>,
                        <?php echo $total_penjualan_november; ?>,
                        <?php echo $total_penjualan_desember; ?>,
                    ],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)',
                    'rgba(255,0,0,0.2)',
                    'rgba(255,153,51,0.2)',
                    'rgba(0,153,0,0.2)',
                    'rgba(102,51,255,0.2)',
                    'rgba(204,255,153,0.3)',
                    'rgba(153,51,0,0.3)',
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
                    'rgba(255,0,0,1)',
                    'rgba(255,153,51,1)',
                    'rgba(0,153,0,1)',
                    'rgba(102,51,255,1)',
                    'rgba(204,255,153,1)',
                    'rgba(153,51,0,1)',
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
</script>

<script>
var produk = document.getElementById("produk").getContext('2d');
		var myChart = new Chart(produk, {
			type: 'bar',
			data: {
				    labels: [<?php
                        foreach ($produk_penjualan as $pp) {
                            foreach ($produk as $p){
                                if($pp->ID_PRODUK==$p->ID_PRODUK){
                                    echo " ' ";
                                    echo  $p->NAMA_PRODUK;
                                    echo " ' ";
                                    echo ',';
                                }
                            }
                         }    
                        ?>],
				datasets: [{
					label: 'Grafik Produk Terlaris',
					data: [ <?php
                        foreach ($produk_penjualan as $pp) {
                            echo $pp->TOTAL_PRODUK_DIJUAL;
                            echo ',';
                        }       
                        ?>],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)',
                    'rgba(255,0,0,0.2)',
                    'rgba(255,153,51,0.2)',
                    'rgba(0,153,0,0.2)',
                    'rgba(102,51,255,0.2)',
                    'rgba(204,255,153,0.3)',
                    'rgba(153,51,0,0.3)',
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
                    'rgba(255,0,0,1)',
                    'rgba(255,153,51,1)',
                    'rgba(0,153,0,1)',
                    'rgba(102,51,255,1)',
                    'rgba(204,255,153,1)',
                    'rgba(153,51,0,1)',
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
</script>
@php
  $x=Session::get('status_toast');
@endphp
@if($x==0)
<script>
toastr.options = {
        timeOut: 3000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 200,
        hideDuration: 200
    };
toastr.success('Welcome !');
</script>
@php Session::put('status_toast','1'); @endphp
@endif
@endsection