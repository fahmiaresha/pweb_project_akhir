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
                        
                <p><strong> Tanggal : </strong>  {{date('d-m-Y', strtotime($fromdate)) }} s/d
                    {{date('d-m-Y', strtotime($todate)) }}</p>  
                </div>
                <div class="form-group col-md-8 text-right">
                <a href="/pdf-nota-supplier/{{$fromdate}}/{{$todate}}/{{$input_supplier}}" target="_blank" class="btn btn-outline-success ml-2"> <i class="fa fa-download mr-2"></i>Laporan</a>
                </div>

                </div>

                <div class="coba" style="margin-top:-15px;">
               
                <p>  <strong> Sort by :   </strong>     
                @if($input_supplier=='kosong')
                    All
                @else
                    @foreach($supplier as $s)
                            @if($s->ID_SUPPLIER==$input_supplier)
                                {{$s->NAMA_SUPPLIER}} - {{$s->ALAMAT_SUPPLIER}}
                            @endif
                    @endforeach
                @endif
                 </p> 
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
                        <td> {{$s->NAMA_SUPPLIER}} - {{$s->ALAMAT_SUPPLIER}}</td>
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
                
                <br>
                <center>
                <div style="height:auto; max-width:100%; cursor:pointer;">
		        <canvas id="myChart"></canvas>
	            </div>
                </center>
              
                <!-- @php $id_supp=0; @endphp
                @foreach($supplier as $s)
                                @foreach($x as $ns)
                                    @if($id_supp!=$ns->ID_SUPPLIER)
                                        @php $lunas=0; $blm_lunas=0; @endphp
                                    @else
                                        @if($id_supp!=0)
                                            @php echo $lunas; @endphp
                                            @php echo $blm_lunas; @endphp
                                        @endif
                                    @endif

                                    @if($s->ID_SUPPLIER==$ns->ID_SUPPLIER)
                                            @if($ns->STATUS_NOTA_SUPPLIER==1)
                                                    @php $lunas = $lunas + $ns->TOTAL_BAYAR_NOTA_SUPPLIER; @endphp
                                            @else
                                                    @php $blm_lunas = $blm_lunas + $ns->TOTAL_BAYAR_NOTA_SUPPLIER; @endphp
                                            @endif
                                        @php $id_supp=$s->ID_SUPPLIER; @endphp
                                    @endif 
                                @endforeach        
                @endforeach -->
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
var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Belum Lunas", "Lunas"],
				datasets: [{
					label: 'Nota Supplier',
					data: [
                        <?php echo $status_belum_dibayar; ?>,
                        <?php echo $status_sudah_dibayar; ?>
                    ],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
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
@endif

@if(session('search_kosong'))
<script>
swal("Oops!","Data Tidak Ditemukan!","error");
</script>
@endif

@endsection