@extends('layouts.template')
@section('title','Penerimaan Barang')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
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
            <h3>Penerimaan</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Penerimaan</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Penerimaan Barang</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">

            <form method="post" action="{{ url('/penerimaan-barang/store') }}" enctype="multipart/form-data">
                @csrf
              <div class="coba mb-2">
                <label for="date" ><font size="4"><strong>Penerimaan #{{$total_penerimaan_barang}}</strong></font></label>
                <input type="hidden" name="id_penerimaan_barang" value="{{$total_penerimaan_barang}}">
              </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nota_date">Tanggal</label>
                        <input type="text" class="form-control @error('nota_date') is-invalid @enderror" 
                        id="nota_date" name="tanggal_penerimaan_barang" 
                        value="@php date_default_timezone_set('Asia/Jakarta'); echo date('d-m-Y H:i:s'); @endphp" readonly>
                    </div>

                    <div class="form-group col-md-4">
                    </div>

        
                    <div class="form-group col-md-4">
                        <label for="Nama">Tanggal Nota</label>
                                <input type="text" name="tanggal_nota" class="form-control" class="demo-code-preview form-control mt-1" placeholder="Tanggal Pembelian" name="tanggal_nota" id="tanggal_nota">
                        <!-- <label for="customer_id">Kategori Pelanggan</label>
                        <select name="kategori11" class="custom-select" id="pelanggan_kategori" onchange="kategori_pelanggan()">
                                <option disabled="true" selected="true" required>Pilih Kategori</option>
                                @foreach($kategori_pelanggan as $kp)
                                <option value="{{ $kp->ID_KATEGORI_PELANGGAN }}" required>{{ $kp->NAMA_KATEGORI_PELANGGAN }}</option>
                                @endforeach
                        </select> -->
                    </div>
                </div>

                <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="kasir">Pegawai</label>
                        <input type="text" class="form-control @error('nota_date') is-invalid @enderror" id="" placeholder="" name="nama_kasir"  value="{{Session::get('nama_user')}}" readonly>
                        <input type="hidden" name="id_kasir" value="{{Session::get('id_user')}}">
                        </div>

                        <div class="form-group col-md-4">
                        </div>

                        <div class="form-group col-md-4"> 
                        <label for="customer_id">Nota</label>
                        <input type="text" class="form-control" id="nomor_nota" placeholder="Nomor Nota..." name="nomor_nota" required >
                        </div>
                </div>
        <div class="form-row">
            <div class="form-group col-md-4">    
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahModal">
                <i class="fa fa-plus-circle mr-2"></i>Penerimaan </button>
            </div>

            <div class="form-group col-md-4">
            </div>

            <div class="form-group col-md-4"> 
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#produkbaru">
                            <i class="fa fa-plus-circle mr-2"></i>Produk</button>
                <div class="div"><h7 style="color:#e3bcba">Klik untuk membuat produk baru...</h5></div>
            </div>

        </div>

            <!-- .modal-lg -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="tambahModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Penerimaan Barang</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered mydatatable table-hover" id="tabelproduk">
                      <thead>
                        <tr>
                          <th width=1px scope="col">#</th>
                          <th scope="col">Supplier</th>
                          <th scope="col">Tanggal Pembelian</th>
                          <th scope="col">Kategori</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Harga Beli</th>
                          <th scope="col">Harga Reseller</th>
                          <th scope="col">Harga Jual</th>
                          <th scope="col">Stok</th>
                          <!-- <th scope="col">Deksripsi</th> -->
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($product as $pr)
                        @if($pr->STOK_PRODUK!=0)
                        <tr id="row{{$pr -> ID_PRODUK}}" style="cursor:pointer;">
                          <th scope="row">
                          <!-- <input type="checkbox" id="pr{{$pr->ID_PRODUK }}" > -->
                         
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="pr{{$pr->ID_PRODUK }}">
                                <label class="custom-control-label" for="pr{{$pr->ID_PRODUK }}"></label>
                            </div>
                       
                          </th>
                          <td>
                          @foreach($supplier as $s)
                            @if($s->ID_SUPPLIER==$pr->ID_SUPPLIER)
                                {{$s->NAMA_SUPPLIER}} - {{$s->ALAMAT_SUPPLIER}}
                            @endif
                          @endforeach
                          </td>
                          <td>
                          {{$pr->TANGGAL_PEMBELIAN_PRODUK}}
                          </td>
                          @foreach($kategori_produk as $kp)
                          
                          @if($pr->ID_KATEGORI_PRODUK==$kp->ID_KATEGORI_PRODUK)
                          <td>
                          {{$kp->NAMA_KATEGORI_PRODUK}}
                          </td>
                          @endif
                          @endforeach
                        
                          <td>{{ $pr->NAMA_PRODUK}}</td>
                          <td >Rp. {{number_format($pr->HARGA_BELI_PRODUK)}}</td>
                          <td >Rp. {{number_format($pr->HARGA_JUAL_RESELLER_PRODUK)}}</td>
                          <td >Rp. {{number_format($pr->HARGA_JUAL_PELANGGAN_PRODUK)}}</td>
                          <td>{{ $pr->STOK_PRODUK}}</td>
                          <!-- <td>{{ $pr->DESKRIPSI_PRODUK}}</td> -->
                        </tr>
                         @endif
                        @endforeach
                        </tbody>
                        </table>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-primary" id="save">Insert</button>
                </div>
                </div>
            </div>
            </div>
            <div class="table-responsive mt-2" id="tabel_cart">
            <div id="keranjang_kosong">
            <center>
           
               <h5 style="color:#e3bcba">Penerimaan Barang Kosong , Silahkan Tambahkan Produk...</h5>
               <br>
            </center>
            </div>
            </div>
            
           
           
           <div class="form-row">
               

                <div class="col-md-4">
                    <label for="Nama" >Foto</label>
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" name="file">
                        <label class="custom-file-label" for="customFile" >Choose file</label>
                    </div>
                    <div class="div mt-1"><h7 style="color:#e3bcba">Tambahkan Foto Jika ada...</h5></div>
                </div>

                <!-- <div class="col-md-4">
                test
                </div> -->
               
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><strong>Catatan</strong></label>
                        <textarea class="form-control reset" name="catatan_penerimaan_barang" id="exampleFormControlTextarea1" rows="4" placeholder="Catatan...."></textarea>
                    </div>
                </div>
           </div>

           <div class="container">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="button" onclick="klik_reset()" class="btn btn-danger mr-1">Reset</button>
                        <button type="submit" class="btn btn-warning">Simpan Penerimaan</button>
                    </div>
                </div>
            </div>
            </form>
            </div>
        </div>
    </div>

<!-- modal tambah produk-->
    <div class="modal fade" tabindex="-1" role="dialog" id="produkbaru">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/data-produk-store-input-penerimaan-barang') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="Kategori">Kategori</label>
                        <select name="kategori" id="select2" class="select2-example">
                        <option disabled="true" selected="true" required>Pilih Kategori</option>
                        @foreach($kategori_produk as $kp)
                        <option value="{{ $kp->ID_KATEGORI_PRODUK }}" required>{{ $kp->NAMA_KATEGORI_PRODUK }}</option>
                        @endforeach
                       </select>
                        <div class="div mt-2">
                        
                        </div>
                       <label for="Kategori">Supplier</label>
                        <select name="supplier" id="supplier" class="select2-example">
                        <option disabled="true" selected="true" required>Pilih Supplier</option>
                        @foreach($supplier as $sp)
                        <option value="{{ $sp->ID_SUPPLIER }}" required>{{ $sp->NAMA_SUPPLIER }}</option>
                        @endforeach
                       </select>

                       <label for="Nama" style="margin-top:10px;">Tanggal Pembelian</label>
                        <div class="form-group">
                        <input type="text" name="daterangepicker" class="form-control" class="demo-code-preview form-control mt-1" placeholder="Tanggal Pembelian" name="daterangepicker" id="daterangepicker" value="{{ old('daterangepicker') }}">
                        </div>
                       
                        <label for="Nama" style="margin-top:10px;">Nama</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Nama Produk" name="nama" value="{{ old('nama') }}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Stok</label>
                        <div class="form-group">
                            <input type="number" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Stok Produk" min="1" name="stok" value="{{ old('stok') }}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Harga Beli</label>
                        <div class="form-group">
                            <input type="text" id="harga_beli" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Harga Beli Produk" name="harga_beli" value="{{ old('harga_beli') }}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Harga Reseller</label>
                        <div class="form-group">
                            <input type="text" id="harga_jual_reseller" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Harga Jual Reseller" name="harga_jual_reseller" value="{{ old('harga_jual_reseller') }}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Harga Jual</label>
                        <div class="form-group">
                            <input type="text" id="harga_jual" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Harga Jual" name="harga_jual" value="{{ old('harga_jual') }}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Foto</label>
                        <div class="form-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" required>
                            <label class="custom-file-label" for="customFile" >Choose file</label>
                        </div>
                        @if(count($errors) > 0)
                        <div class="alert alert-danger mt-2">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                        @endif
                        </div>

                        <label for="Nama" style="margin-top:10px;">Deskripsi</label>
                        <div class="form-group">
                        <textarea class="demo-code-preview form-control mt-1"
                        placeholder="Deskripsi Produk" name="deskripsi_produk" value="{{ old('deskripsi_produk') }}"></textarea>
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
@endsection

@section('script')
<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>
<script src="vendors/datepicker/daterangepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<script>
$(document).ready(function (){
    $('.mydatatable').DataTable({
        "order":[[1,"asc"]]
    });
    $('.select2-example').select2();
    $('#select2').select2();

    $('input[name="tanggal_nota"]').daterangepicker({
    timePicker: true,
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        format: 'DD-M-YY hh:mm A'
        }
    });

    $('input[name="daterangepicker"]').daterangepicker({
      timePicker: true,
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
          format: 'DD-M-YY hh:mm A'
        }
    });


});

var angka=0;
jQuery( function( $ ) {
    $("#save").click(function(){
      if(angka==0){
        var tambah_tabel= '\<table class="table table-bordered table-hover table-active" id="cart"></font>\
                                  <thead>\
                                  <tr>\
                                  <th style="font-weight:bold; text-align:center;">Supplier</th>\
                                  <th style="font-weight:bold; text-align:center;">Tanggal Pembelian</th>\
                                  <th style="font-weight:bold; text-align:center;">Kategori</th>\
                                  <th style="font-weight:bold; text-align:center;">Produk</th>\
                                  <th style="font-weight:bold; text-align:center;">Stok</th>\
                                  <th style="font-weight:bold; text-align:center;">Jumlah Diterima</th>\
                                  <th style="font-weight:bold; text-align:center;">Aksi</th>\
                                  </tr>\
                                </thead>\
                                    <tbody>\
                                    </tbody>\
                                </table>';
                                $("#keranjang_kosong").hide(); 
                                $("#tabel_cart").append(tambah_tabel); 
        angka=1;
      }
          var checks = $("#tambahModal").find("input[type=checkbox]:checked");
          var ids = Array();
          for(var i=0;i<checks.length;i++) {
              ids[i] = checks[i].id; 
              $("#"+ids[i]).prop("checked", false);
              ids[i] = ids[i].substring(2,10); //PR001
              console.log(ids[i]);
              if( $("#cart tbody tr#"+ids[i]).length){
                console.log('masuk ifff');
                  $('#jumlah'+ids[i]).val(parseInt($('#jumlah'+ids[i]).val())+1);  
                  recount(ids[i]);
              }
              else{   
                addRow(ids[i]);
              }
              // $("#tabelproduk tbody tr#row"+ids[i]).hide();
          }
        });

        // function agar di klik row mana saja bsa ke ceklis
        $('#tabelproduk tr').click(function() {
            var check = $(this).find("input[type=checkbox]");
            if (check.prop("checked") == true) {
              check.prop("checked", false);
            }
            else{
              check.prop("checked", true);
            }
        });
});

var products = <?php echo json_encode($product); ?>;
var suppliers = <?php echo json_encode($supplier); ?>;
var kategori_produks = <?php echo json_encode($kategori_produk); ?>;
// console.log(suppliers);
// console.log(products);
function getIndex(id){
	for(var i = 0;i<products.length;i++){
	  if(products[i]["ID_PRODUK"] == id){
	      var index = i;
        // console.log('function getIndex');
        // console.log(index);
	      return index;
	  }
	}
}

function getIndex_supplier(id){
	for(var k = 0;k<suppliers.length;k++){
	  if(suppliers[k]["ID_SUPPLIER"] == id){
	      var index2 = k;
	      return index2;
	  }
	}
}

function getIndex_kategori_produk(id){
	for(var j = 0;j<kategori_produks.length;j++){
	  if(kategori_produks[j]["ID_KATEGORI_PRODUK"] == id){
	      var index3 = j;
	      return index3;
	  }
	}
}

function addRow(id){
      var index = getIndex(id);
      var id = products[index]["ID_PRODUK"];
      var supplier = products[index]["ID_SUPPLIER"];
      var name = products[index]["NAMA_PRODUK"];
      var id_kategori_produk = products[index]["ID_KATEGORI_PRODUK"];
      var tgl_pembelian = products[index]["TANGGAL_PEMBELIAN_PRODUK"];
      var stok_produk = products[index]["STOK_PRODUK"];


      var index2 = getIndex_supplier(supplier);
      var name_supplier = suppliers[index2]["NAMA_SUPPLIER"];
      var alamat_supplier = suppliers[index2]["ALAMAT_SUPPLIER"];

      var index3 = getIndex_kategori_produk(id_kategori_produk);
      var name_kategori_produk = kategori_produks[index3]["NAMA_KATEGORI_PRODUK"];

      var markup = "\
      <tr id='"+id+"' style='border: 1px;'>\
      \
	  <td style='text-align: left; padding-left: 25px;' >\
	    <div class='row'>\
	      <h6 class='NAMA_SUPPLIER'>"+name_supplier+" - "+alamat_supplier+"</div>\
	    <div class='row'>\
	      <input type='hidden' name='ID_SUPPLIER["+id+"]'  readonly id='ID_SUPPLIER"+id+"' value='"+supplier+"'></div>\
	  </td>\
	  \
      \
	  <td style='text-align: left; padding-left: 25px;' class='align-middle'>\
	    <div class='row'>\
	      <h6 class='TGL_PEMBELIAN'>"+tgl_pembelian+"</div>\
	    <div class='row'>\
	      <input type='hidden' name='TGL_PEMBELIAN["+id+"]' readonly id='TGL_PEMBELIAN"+id+"' value='"+tgl_pembelian+"'></div>\
	  </td>\
	  \
      \
	  <td style='text-align: left; padding-left: 25px;' class='align-middle'>\
	    <div class='row'>\
	      <h6 class='NAMA_PRODUK'>"+name_kategori_produk+"</div>\
	    <div class='row'>\
	      <input type='hidden' name='ID_KATEGORI_PRODUK["+id+"]' value='"+id_kategori_produk+"'  readonly id='ID_KATEGORI_PRODUK"+id+"'></div>\
	  </td>\
	  \
	  \
	  <td style='text-align: left; padding-left: 25px;' class='align-middle'>\
	    <div class='row'>\
	      <h6 class='NAMA_PRODUK'>"+name+"</div>\
	    <div class='row'>\
	      <input type='hidden' name='ID_PRODUK["+id+"]' value="+id+" readonly id='ID_PRODUK"+id+"'></div>\
	  </td>\
	  \
      \
	  <td style='text-align: left; padding-left: 25px;' class='align-middle'>\
	    <div class='row'>\
	      <h6 class='STOK_PRODUK' >"+stok_produk+"</div>\
	    <div class='row'>\
	      <input type='hidden' name='STOK_PRODUK["+id+"]' value='"+stok_produk+"' readonly id='STOK_PRODUK"+id+"'></div>\
	  </td>\
	  \
	  <td style='width: 15%;' class='align-middle'>\
	    <div class='row justify-content-center'>\
      <button class='dec btn btn-sm btn-dark' type='button' onclick='dec(\""+id+"\")'>-</button>\
	    	<input type='number' style='background-color:#808080; -moz-appearance: textfield; width: 30%; border:1px;text-align: center;' class='quantity' oninput='recount(\""+id+"\")' name='jumlah["+id+"]' min='1' id='jumlah"+id+"'required value='1'>\
        <button class='inc btn btn-sm btn-dark' type='button' onclick='inc(\""+id+"\")'>+</button>\
	    </div>\
	  </td>\
	  \
	  <td style='width: 5%;' class='align-middle'>\
	  	<i class='btn btn-outline-danger' onclick='delRow(\""+id+"\")' style='cursor: pointer; '>x</i>\
	  </td>\
	</tr>\
	";
	$("#cart tbody").append(markup);
	
}



    function delRow(id){
          $('#cart tbody tr#'+id).remove();
          $("#tabelproduk tbody tr#row"+id).show();
    }

    function inc(id){
          var oldValue = $("#jumlah"+id).val();//jumlahPR004
          console.log('Nilai Old Value : ');
          console.log(oldValue);
          var newVal = parseFloat(oldValue)+1;
          console.log('Nilai newVal : ');
          console.log(newVal);
          var maximal = $("#jumlah"+id).attr('max');
          if(!(newVal > maximal)){
            $("#jumlah"+id).val(newVal);
          }
    }
        function dec(id){
          var oldValue = $("#jumlah"+id).val();
          if (parseFloat(oldValue) > 1) {
              var newVal = parseFloat(oldValue)-1;
              $("#jumlah"+id).val(newVal);
          }
        }


function klik_reset(){
  $("#cart").remove();
  angka=0;
  // $('form :input').val('');
  $('#nomor_nota').val('');
  $('.reset').val('');
  $("#cart").remove();
  $("#keranjang_kosong").show();
}

var harga_beli = document.getElementById('harga_beli');
        harga_beli.addEventListener('keyup', function(e){
        harga_beli.value = formatRupiah(this.value, 'Rp. ');
		});

var harga_jual_reseller = document.getElementById('harga_jual_reseller');
        harga_jual_reseller.addEventListener('keyup', function(e){
        harga_jual_reseller.value = formatRupiah(this.value, 'Rp. ');
		});

var harga_jual = document.getElementById('harga_jual');
        harga_jual.addEventListener('keyup', function(e){
        harga_jual.value = formatRupiah(this.value, 'Rp. ');
		});

var update_harga_beli = document.getElementsByClassName('update_harga_beli');
    for(let i=0;i<update_harga_beli.length;i++){
    update_harga_beli[i].addEventListener('keyup',function(e){
        update_harga_beli[i].value = formatRupiah(this.value, 'Rp. ');
    });
    }

var update_jual_reseller = document.getElementsByClassName('update_jual_reseller');
    for(let i=0;i<update_jual_reseller.length;i++){
    update_jual_reseller[i].addEventListener('keyup',function(e){
        update_jual_reseller[i].value = formatRupiah(this.value, 'Rp. ');
    });
    }

var update_harga_jual = document.getElementsByClassName('update_harga_jual');
    for(let i=0;i<update_harga_jual.length;i++){
    update_harga_jual[i].addEventListener('keyup',function(e){
        update_harga_jual[i].value = formatRupiah(this.value, 'Rp. ');
    });
    }

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
swal("Success!","Data Penerimaan Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('insert_produk'))
<script>
swal("Success!","Data Produk Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('gagal'))
<script>
swal("Oops!","Data Penerimaan Gagal Di Tambahkan","error");
</script>
@endif
       
@endsection