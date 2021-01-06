@extends('layouts.template')
@section('title',' Tambah Stok Produk')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Produk</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Produk</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Stok Produk</li>
                </ol>
            </nav>
        </div>
    </div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
        
         <!-- modal -->
         <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i> Stok Produk</button>

            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Stok Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/update-stok-produk') }}">
                    @csrf
                
                    <label for="supplier">Supplier</label>
                        <select name="supplier" id="supplier" class="select2-example">
                        <option disabled="true" selected="true" required>Pilih Supplier</option>
                        @foreach($supplier as $s)
                        <option value="{{ $s->ID_SUPPLIER }}" required>{{ $s->NAMA_SUPPLIER }} - {{ $s->ALAMAT_SUPPLIER }}</option>
                        @endforeach
                    </select>

                    <label for="validationCustom03" class="mt-3">Produk </label>
                    <select class="select2-example" name="produk" id="produk">
                    <option value="0" disabled="true" selected="true">Pilih Supplier Dulu</option>
                    </select>

                   
                    <input type="hidden" name="nama_user" value="{{Session::get('id_user')}}">
                   
                    <input type="hidden" name="kategori_produk" id="kategori_produk" value="">
                    
                 
                <div id="append_html"></div>
                 
                       

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
             <!-- tutup modal -->

            <table id="myTable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>Kategori</th>
                        <th>Produk</th>
                        <th>Tanggal Pembelian</th>
                        <th>Stok Awal</th>
                        <th>Stok Ditambah</th>
                        <th>Stok</th>
                        <th>Pegawai</th>
                        </tr>
                    </thead>
                <tbody> 
                    @foreach($update_stok as $us)
                    <tr>
                        <td>{{date('d-m-Y H:i:s', strtotime($us->waktu_update_stok)) }}</td>
                        <td>
                        @foreach($supplier as $s)
                            @if($s->ID_SUPPLIER==$us->nama_supplier)
                                {{$s->NAMA_SUPPLIER}} - {{ $s->ALAMAT_SUPPLIER }}
                            @endif
                        @endforeach
                       </td>
                       <td>
                        @foreach($kategori_produk as $kp)
                            @if($kp->ID_KATEGORI_PRODUK==$us->kategori_produk)
                                {{$kp->NAMA_KATEGORI_PRODUK}}
                            @endif
                        @endforeach
                        </td>
                        <td>
                        @foreach($produk as $p)
                            @if($p->ID_PRODUK==$us->nama_produk)
                                {{$p->NAMA_PRODUK}}
                            @endif
                        @endforeach
                        </td>
                        <td>{{$us->tanggal_pembelian_produk}}</td>
                        <td style="text-align:center;">{{$us->stok_saat_ini}}</td>
                        <td style="text-align:center;">{{$us->stok_ditambah}}</td>
                        <td style="text-align:center;">{{$us->stok_total}}</td>
                        <td>
                        @foreach($user as $u)
                            @if($u->id==$us->nama_user)
                                {{$u->name}}
                            @endif
                        @endforeach
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
<script>
$(document).ready(function (){
    $('#myTable').DataTable();
    $('.select2-example').select2();
});

var status_append=0;
var var_id_kategori_produk;
var posisi_id_kategori_produk;

jQuery(document).ready(function ()
    {
      $('.select2-example').select2();
            jQuery("#supplier").change(function(){
               var produk = jQuery(this).val();
               console.log(produk);
               if(produk)
               {
                console.log('masuk if produk');
                  jQuery.ajax({
                     url : 'get_produk/' +produk,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        jQuery('select[name="produk"]').empty();
                        $('select[name="produk"]').append('<option value="0" disabled="true" selected="true">Pilih Produk</option>');
                        jQuery.each(data, function(key,value){
                           $('select[name="produk"]').append('<option value="'+ value.ID_PRODUK +'">'+ value.NAMA_PRODUK +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="produk"]').empty();
                  console.log('masuk else');
               }
            });

            jQuery('select[name="produk"]').on('change',function(){
               var kota = jQuery(this).val();
               if(kota)
               {
                console.log('masuk if produk');
                  jQuery.ajax({
                     url : 'get_detail_produk/' +kota,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                         
                        if(status_append==0){
                            var append_html=
                            '\<label for="Nama" style="margin-top:10px;">Kategori</label>\
                            <input type="text" class="demo-code-preview form-control mt-1" name="nama_kategori_produk" id="nama_kategori_produk" readonly>\
                            <label for="Nama" style="margin-top:10px;">Tanggal Pembelian</label>\
                            <input type="text" class="demo-code-preview form-control mt-1" name="tanggal_pembelian" id="tanggal_pembelian" readonly>\
                            <label for="Nama" style="margin-top:10px;">Harga Beli</label>\
                            <input type="text" class="demo-code-preview form-control mt-1" name="harga_beli" id="harga_beli" readonly>\
                            <label for="Nama" style="margin-top:10px;">Harga Reseller</label>\
                            <input type="text" class="demo-code-preview form-control mt-1" name="harga_jual_reseller" id="harga_jual_reseller" readonly>\
                            <label for="Nama" style="margin-top:10px;">Harga</label>\
                            <input type="text" class="demo-code-preview form-control mt-1" name="harga_jual" id="harga_jual" readonly>\
                            <label for="Nama" style="margin-top:10px;">Stok Saat Ini</label>\
                            <input type="text" class="demo-code-preview form-control mt-1" name="stok_saat_ini" id="stok_saat_ini" readonly>\
                            <label for="Nama" style="margin-top:10px;">Tambah Stok</label>\
                            <input type="number" class="demo-code-preview form-control mt-1" placeholder="Tambah Stok" name="tambah_stok" id="tambah_stok" >';
                            $("#append_html").append(append_html);
                            status_append=10;
                        }
                        // console.log(data);
                       
                        jQuery.each(data, function(key,result){
                            document.getElementById("tanggal_pembelian").value =result.TANGGAL_PEMBELIAN_PRODUK ;
                            document.getElementById("kategori_produk").value =result.ID_KATEGORI_PRODUK ;
                            document.getElementById("harga_beli").value = money(result.HARGA_BELI_PRODUK) ;
                            document.getElementById("harga_jual_reseller").value = money(result.HARGA_JUAL_RESELLER_PRODUK) ;
                            document.getElementById("harga_jual").value = money (result.HARGA_JUAL_PELANGGAN_PRODUK) ;
                            document.getElementById("stok_saat_ini").value =result.STOK_PRODUK ;
                            var_id_kategori_produk=result.ID_KATEGORI_PRODUK;
                            get_kategori_produk();
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="produk"]').empty();
                  console.log('masuk else kecamatan');
               }
            });


        });

function get_kategori_produk(){
    // console.log("get kategori produk");
    console.log(var_id_kategori_produk);
    var array_id_kategori_produk = [<?php  foreach ($kategori_produk as $kp) {
                      echo '"';
                      echo $kp->ID_KATEGORI_PRODUK;
                      echo '"';
                      echo ',';
                }
                ?>];

    var array_nama_kategori_produk= [<?php  foreach ($kategori_produk as $kp) {
                      echo '"';
                      echo $kp->NAMA_KATEGORI_PRODUK;
                      echo '"';
                      echo ',';
                    }
                    ?>];

    for (var i = 0; i < array_id_kategori_produk.length; i++) {
        if(var_id_kategori_produk==array_id_kategori_produk[i]){
            posisi_id_kategori_produk=i;
        }
        // console.log(array_id_kategori_produk[i]);
    }

    // console.log(posisi_id_kategori_produk);
    // console.log(array_nama_kategori_produk[posisi_id_kategori_produk]);
    document.getElementById("nama_kategori_produk").value =array_nama_kategori_produk[posisi_id_kategori_produk];
    

    // for (var i = 0; i < array_nama_kategori_produk.length; i++) {
    //     console.log(array_nama_kategori_produk[i]);
    // }
    
}

function money(text){
	var text = text.toString();
  // console.log(text);
	var panjang = text.length; //4
	var hasil = new Array();
	if (panjang>0){
		if(panjang>3){
			var div = parseInt(panjang/3); //1
			var char = new Array();
			var result="";
			if (div > 1 && panjang > 6) {
				var x = parseInt(panjang - (div*3));
				div++;
				for (var i=0; i<div; i++) {
					if (i == 0) {
						char[i] = text.slice(i,x);
					}
					else{
						char[i] = text.slice(((i-1)*3)+x,(i*3)+x);
					}
					if (i == (div-1)) {					
						hasil[i]= char[i];
					}
					else{
						hasil[i]= char[i]+".";
					}
				}
				for (var i=0; i<div; i++) {
					result+=hasil[i];
				}
			}
			else{
				result = text.slice(0,panjang-3)+"."+text.slice(panjang-3,panjang);
			//  console.log( text.slice(0,panjang-3));
      //  console.log(text.slice(panjang-3,panjang));
      }
			return result;
		}
    else if(panjang>0){
        return text;
    }
		return 0;
	}
}
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
swal("Success!","Update stok berhasil !","success");
</script>
@endif

@if (session('pilih_produk'))
<script>
swal("Oops!","Pilih produk dahulu !","error");
</script>
@endif

@endsection