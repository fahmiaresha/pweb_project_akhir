@extends('layouts.template')
@section('title','Nota Supplier')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

<link rel="stylesheet" href="vendors/lightbox/magnific-popup.css" type="text/css">

<!-- rangepicker -->
<link rel="stylesheet" href="vendors/datepicker/daterangepicker.css" type="text/css">

<style>
.noBorder {
    border:none !important;
}
</style>
@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Supplier</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Supplier</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Nota Supplier</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i> Nota Supplier</button>

            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible" role="alert">
            <i class="fa fa-warning"></i> {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <i class="ti-close"></i>
            </button>
            </div>
            @endforeach
            
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Nota Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/nota-supplier-store') }}" enctype="multipart/form-data">
                        @csrf

                        <label for="nama_supplier">Supplier</label>
                        <select name="nama_supplier" id="nama_supplier" class="select2-example">
                        <option value="-" disabled="true" selected="true">Pilih Nama Supplier</option>
                        @foreach($supplier as $s)
                        <option value="{{ $s->ID_SUPPLIER }}">{{ $s->NAMA_SUPPLIER }} - {{ $s->ALAMAT_SUPPLIER }}</option>
                        @endforeach
                       </select>

                       <label for="Nama" style="margin-top:10px;">Nomor</label>
                        <div class="form-group">
                        <input type="text" name="nomor_nota" class="demo-code-preview form-control mt-1" placeholder="Nomor Nota" value="{{ old('nomor_nota') }}">
                        </div>

                       <label for="Nama" style="margin-top:10px;">Tanggal Nota</label>
                        <div class="form-group">
                        <input type="text" name="daterangepicker" class="demo-code-preview form-control mt-1" placeholder="Tanggal Nota" id="daterangepicker" value="{{ old('daterangepicker') }}">
                        </div>
                       
                        <label for="Nama" style="margin-top:10px;">Total</label>
                        <div class="form-group">
                        <input type="text" class="demo-code-preview form-control mt-1" placeholder="Total Bayar" name="total_bayar" id="total_bayar" value="{{ old('total_bayar') }}">
                        </div>

                        <label for="Nama" >Foto</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" required>
                            <label class="custom-file-label" for="customFile" >Choose file</label>
                        </div>

                       
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Insert</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
             <!-- tutup modal -->
                <table id="myTable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                        <th>Status</th>
                        <th>Nomor Nota</th>
                        <th>Tanggal Nota</th>
                        <th>Nama Supplier</th>
                        <th>Total Bayar</th>
                        <!-- <th>Foto</th> -->
                        <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($nota_supplier as $ns)
                    <tr>
                    <td>
        <form class="post0" method="post" action="{{ url('/update-status-nota-supplier') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $ns->ID_NOTA_SUPLIER }}">
          @if($ns->STATUS_NOTA_SUPPLIER == 1)
          <div class="custom-control custom-switch">
          <input type="checkbox" checked class="custom-control-input" id="switch{{ $ns->ID_NOTA_SUPLIER }}">
          <label class="custom-control-label" for="switch{{ $ns->ID_NOTA_SUPLIER }}"></label>
          </div>
          <span class="badge badge-success"><font size="1">Selesai</font></span>
            
            @else
          <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="switch{{ $ns->ID_NOTA_SUPLIER }}">
          <label class="custom-control-label" for="switch{{ $ns->ID_NOTA_SUPLIER }}"></label>
          </div>
          <span class="badge badge-danger"><font size="1">Belum Selesai</font></span>    
         @endif 
      </form>
                    </td>
                    <td>
                    {{$ns->NOMOR_NOTA_SUPPLIER}}
                    </td>
                    <td>
                    {{date('d-m-Y', strtotime($ns->TANGGAL_NOTA_DATANG)) }}
                    </td>
                    @foreach($supplier as $s)
                        @if($s->ID_SUPPLIER==$ns->ID_SUPPLIER)
                        <td>{{$s->NAMA_SUPPLIER }} - {{ $s->ALAMAT_SUPPLIER }}</td>
                        @endif
                    @endforeach
                    <td>Rp. {{ number_format($ns->TOTAL_BAYAR_NOTA_SUPPLIER)}}</td> 
                    <!-- <td><img width="150px" src="{{ url('/data_file/'.$ns->FOTO_NOTA_SUPPLIER) }}"></td>                                  -->
                    <td>
                             <!-- Button trigger modal -->
                             <!-- <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editModal{{ $ns->ID_NOTA_SUPLIER }}">
                             <i class="fa fa-pencil mr-1"></i>Edit
                             
                            </button>

                          
                            <div class="modal fade" id="editModal{{ $ns->ID_NOTA_SUPLIER }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pesan Supplier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                <form method="post" action="{{ url('/nota-supplier-update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $ns->ID_NOTA_SUPLIER }}">

                                <label for="Kategori">Pelanggan</label>
                                <select name="nama_supplier" id="nama_supplier"  class="form-control">
                                @foreach($supplier as $s)
                                @if($ns->ID_SUPPLIER==$s->ID_SUPPLIER)         
                                <option selected value="{{ $ns->ID_SUPPLIER }}" required>{{ $s->NAMA_SUPPLIER }}</option>
                                @else
                                <option value="{{ $s->ID_SUPPLIER }}" required>{{ $s->NAMA_SUPPLIER }}</option>
                                @endif
                                @endforeach
                                </select>

                                <label for="Nama" style="margin-top:10px;">Total</label>
                                <div class="form-group">
                                <input type="text" class="demo-code-preview form-control mt-1 total_bayar2" placeholder="Total Bayar" name="total_bayar" id="total_bayar2" value="{{$ns->TOTAL_BAYAR_NOTA_SUPPLIER}}">
                                </div>

                                <label for="Nama">Foto</label>
                                <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" value="{{ url('/data_file/'.$ns->FOTO_NOTA_SUPPLIER) }}" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            
                               
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-primary">Update</button> 
                            </form>
                                </div>
                                </div>
                            </div>
                            </div>  -->

                            <!-- tutup Button trigger modal edit -->
                <!-- <center> -->
                
            <button type="button" class="btn btn-outline-info mb-1 ml-2" data-toggle="modal" data-target="#modalwa{{ $ns->ID_NOTA_SUPLIER }}">
            <i class="fa fa-info-circle mr-1"></i>Detail
            </button>
            <!-- </center>  -->
                    <!-- modal wa-->
            <div class="modal fade" id="modalwa{{ $ns->ID_NOTA_SUPLIER }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Nota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                @foreach($supplier as $s)
                @if($ns->ID_SUPPLIER==$s->ID_SUPPLIER) 
                <div class="coba" >
                <center class="image-popup" href="{{ url('/foto_nota_supplier/'.$ns->FOTO_NOTA_SUPPLIER) }}">
                <img data-dismiss="modal" style="height:auto; max-width:75%; cursor:zoom-in;" src="{{ url('/foto_nota_supplier/'.$ns->FOTO_NOTA_SUPPLIER) }}" >
                </center>
                </div>
                   <br>
                                              <table class="table table-active table-hover">
                                                <tbody>
                                                <tr>
                                                <td class=""> <strong> Nama Supplier  <strong></td>
                                                <td class=""> {{$s->NAMA_SUPPLIER}} </td>
                                                </tr>
                                                <tr>
                                                <td class="text-wrap " style="text-align:justify"><strong> Alamat Supplier </strong></td>
                                                <td class=""> {{$s->ALAMAT_SUPPLIER}}</td>
                                                </tr>
                                                <tr>
                                                <td class=""><strong>Telp Supplier <strong> </td>
                                                <td class="text-wrap " style="text-align:justify" > {{$s->TELP_SUPPLIER}}</td>
                                                </tr>
                                                <tr>
                                                <td class=""><strong>Email Supplier <strong> </td>
                                                <td class="text-wrap " style="text-align:justify" > {{$s->EMAIL_SUPPLIER}}</td>
                                                
                                                </tr>
                                                </tbody>
                                              </table>
                                            
                                            
                  
                @endif
                @endforeach

                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button> -->
                    <!-- <button type="button" class="btn btn-primary">Kirim Pesan</button> -->
                <!-- </div> -->
                </div>
            </div>
            </div>
                                    
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
        </div>
    </div>
    </div>


                                      

@endsection

@section('script')
<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>
<script src="vendors/lightbox/jquery.magnific-popup.min.js"></script>
<script src="vendors/datepicker/daterangepicker.js"></script>

<script>


$(document).ready(function (){
    $('#myTable').DataTable();
    $('.select2-example').select2();
    const x = document.getElementsByClassName('post0');
    for(let i=0;i<x.length;i++){
    x[i].addEventListener('click',function(){
        x[i].submit();
    });
    }

  
   

    $('.image-popup').magnificPopup({
    type: 'image',
    zoom: {
        enabled: true,
        duration: 300,
        easing: 'ease-in-out',
        opener: function(openerElement) {
            return openerElement.is('img') ? openerElement : openerElement.find('img');
        }
    }  
});

$('input[name="daterangepicker"]').daterangepicker({
  singleDatePicker: true,
  showDropdowns: true,
  locale: {
      format: 'DD-MM-YYYY'
    }
});

});




function tutup_modal(id){
    console.log(id);
    console.log('masuk tutup modal');
        $('#id').modal('hide');
    }

var rupiah = document.getElementById('total_bayar');
// var rupiah = document.getElementsByClassName("total_bayar");
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
            // console.log(Number(y));
		});

var rupiah2 = document.getElementsByClassName('total_bayar2');
for(let i=0;i<rupiah2.length;i++){
    rupiah2[i].addEventListener('keyup',function(e){
        rupiah2[i].value = formatRupiah(this.value, 'Rp. ');
    });
    }

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
</script>



@if (session('insert'))
<script>
swal("Success!","Data Nota Supplier Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('update'))
<script>
swal("Success!","Data Nota Supplier Berhasil Di Update","success");
</script>
@endif

@if (session('update_pesan'))
<script>
swal("Success!","Status Nota Supplier Berhasil Di Update","success");
</script>
@endif
@endsection