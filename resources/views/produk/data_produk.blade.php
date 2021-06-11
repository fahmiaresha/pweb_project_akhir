@extends('layouts.template')
@section('title','Data Produk')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">
<!-- rangepicker -->
<link rel="stylesheet" href="vendors/datepicker/daterangepicker.css" type="text/css">

<link rel="stylesheet" href="vendors/lightbox/magnific-popup.css" type="text/css">

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
                    <li class="breadcrumb-item active" aria-current="page">Data Produk</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i> Data Produk</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/data-produk-store') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="Kategori">Kategori</label>
                        <select name="kategori" id="select2" required class="select2-example">
                        <option disabled="true" selected="true" value="" required>Pilih Kategori</option>
                        @foreach($kategori_produk as $kp)
                        <option value="{{ $kp->ID_KATEGORI_PRODUK }}" required>{{ $kp->NAMA_KATEGORI_PRODUK }}</option>
                        @endforeach
                       </select>
                        <div class="div mt-2">
                        
                        </div>
                       <label for="Kategori">Supplier</label>
                        <select name="supplier" id="supplier" required class="select2-example">
                        <option disabled="true" selected="true" value="">Pilih Supplier</option>
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
                        placeholder="Deskripsi Produk" name="deskripsi_produk" value="{{ old('deskripsi_produk') }}" required></textarea>
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
                        <!-- <th>No</th> -->
                        <th>Tanggal Pembelian</th>
                        <th>Kategori</th>
                        <th>Supplier</th>     
                        <th>Nama</th>
                        <th>Stok</th>
                    
                            <th>Harga Beli</th>
                            <th>Harga Reseller</th>
                            <th>Harga Jual</th>
                        <th>Foto</th>
                        <th>Deksripsi</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($produk as $p)
                    <tr>
                    <td>{{ $p->TANGGAL_PEMBELIAN_PRODUK }}</td>
                    @foreach($kategori_produk as $kp)
                        @if($kp->ID_KATEGORI_PRODUK==$p->ID_KATEGORI_PRODUK)
                        <td>{{ $kp->NAMA_KATEGORI_PRODUK }}</td>
                        @endif
                    @endforeach

                    @foreach($supplier as $s)
                        @if($p->ID_SUPPLIER==$s->ID_SUPPLIER)
                        <td>{{$s->NAMA_SUPPLIER}} - {{$s->ALAMAT_SUPPLIER}}</td>
                        @endif
                    @endforeach
                    <td>{{$p->NAMA_PRODUK}}</td>
                    <td>{{$p->STOK_PRODUK}}</td>
                    <td>Rp. {{number_format($p->HARGA_BELI_PRODUK)}}</td>
                    <td>Rp. {{number_format($p->HARGA_JUAL_RESELLER_PRODUK)}}</td>
                    <td>Rp. {{number_format($p->HARGA_JUAL_PELANGGAN_PRODUK)}}</td>
                    
                    <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#lihatfoto{{ $p->ID_PRODUK }}">
                    <i class="fa fa-image mr-1"></i>Lihat
                            </button>

                            <div class="modal fade" id="lihatfoto{{ $p->ID_PRODUK }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$p->NAMA_PRODUK}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                <div class="coba" >
                                <center class="image-popup" href="{{ url('/foto_produk/'.$p->FOTO_PRODUK) }}">
                                <img data-dismiss="modal" style="height:auto; max-width:100%; cursor:zoom-in;" src="{{ url('/foto_produk/'.$p->FOTO_PRODUK) }}" >
                                </center>
                                </div>
                                
                                
                                </div>
                                <!-- <div class="modal-footer"> -->
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-primary">Update</button> -->
                               
                        
                                </div>
                                </div>
                            </div>
                            </div> 
                    </td>
                    <td>{{$p->DESKRIPSI_PRODUK}}</td>
                    <td>
                             <!-- Button trigger modal -->
                             <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editModal{{ $p->ID_PRODUK }}">
                             <i class="far fa-edit mr-1"></i>Edit
                            </button>

                          
                            <div class="modal fade" id="editModal{{ $p->ID_PRODUK }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                <form method="post" action="{{ url('/data-produk-update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $p->ID_PRODUK }}">
                                <input type="hidden" name="nama_user" value="{{Session::get('id_user')}}">

                                <label for="Kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control">
                                @foreach($kategori_produk as $kp)
                                @if($kp->ID_KATEGORI_PRODUK==$p->ID_KATEGORI_PRODUK)  
                                <option selected value="{{ $p->ID_KATEGORI_PRODUK }}" required>{{ $kp->NAMA_KATEGORI_PRODUK }}</option>
                                @else
                                <option value="{{ $kp->ID_KATEGORI_PRODUK }}" required>{{ $kp->NAMA_KATEGORI_PRODUK }}</option>
                                @endif
                                @endforeach
                                </select>

                                <div class="div mt-2">
                        
                                </div>

                                <label for="Kategori">Supplier</label>
                                <select name="supplier" id="supplier" class="form-control">
                                @foreach($supplier as $sp)
                                @if($sp->ID_SUPPLIER==$p->ID_SUPPLIER)  
                                <option selected value="{{ $p->ID_SUPPLIER }}" required>{{ $sp->NAMA_SUPPLIER }}</option>
                                @else
                                <option value="{{ $sp->ID_SUPPLIER }}" required>{{ $sp->NAMA_SUPPLIER }}</option>
                                @endif
                                @endforeach
                                </select>

                                <label for="Nama" style="margin-top:10px;">Tanggal Pembelian</label>
                                <div class="form-group">
                                <input type="text" name="daterangepicker" class="form-control" class="demo-code-preview form-control mt-1" placeholder="Tanggal Pembelian" name="daterangepicker" id="daterangepicker" value="{{$p->TANGGAL_PEMBELIAN_PRODUK}}">
                                </div>

                        <label for="Nama" style="margin-top:10px;">Nama</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Nama Produk" name="nama" value="{{$p->NAMA_PRODUK}}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Stok</label>
                        <div class="form-group">
                            <input type="number" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Stok Produk" name="stok" min="1" value="{{$p->STOK_PRODUK}}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Harga Beli</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1 update_harga_beli" 
                            id="nama" placeholder="Harga Beli Produk" name="harga_beli" value="{{$p->HARGA_BELI_PRODUK}}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Harga Reseller</label>
                        <div class="form-group">
                            <input type="text"  class="demo-code-preview form-control mt-1 update_jual_reseller" 
                            id="nama" placeholder="Harga Jual Reseller" name="harga_jual_reseller" value="{{$p->HARGA_JUAL_RESELLER_PRODUK}}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Harga Jual</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1 update_harga_jual" 
                            id="nama" placeholder="Harga Jual" name="harga_jual" value="{{$p->HARGA_JUAL_PELANGGAN_PRODUK}}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Foto</label>
                        <div class="form-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file">
                            <label class="custom-file-label" for="customFile" >Choose file</label>
                        </div>
                        <p style="color:#e3bcba;" class="mt-2">*Kosongkan jika tidak ingin mengubah foto produk</p>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Deskripsi</label>
                        <div class="form-group">
                        <textarea class="demo-code-preview form-control mt-1"
                        placeholder="Deskripsi Produk" name="deskripsi_produk" value="{{$p->DESKRIPSI_PRODUK}}" required>{{$p->DESKRIPSI_PRODUK}}</textarea>
                        </div>
                           
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                               
                            </form>
                                </div>
                                </div>
                            </div>
                            </div> 

                            @php $x=0; @endphp
                            @foreach($detail_penjualan as $pp)
                                @if($p->ID_PRODUK==$pp->ID_PRODUK)
                                    @php $x=1; @endphp
                                @endif
                            @endforeach

                            @foreach($detail_penerimaan_barang as $dp)
                                @if($p->ID_PRODUK==$dp->ID_PRODUK)
                                    @php $x=1; @endphp
                                @endif
                            @endforeach

                            @if($x==0)

                                      <!-- Button trigger modal -->
                                      <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" 
                                        data-target="#delete1123{{ $p->ID_PRODUK }}">
                                        <i class="fas fa-trash-restore mr-1"></i>Hapus</button>
                                       
                            @else
                                    <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" 
                                        data-target="#delete1123" onclick="tampil_cant_delete()">
                                        <i class="fas fa-trash-restore mr-1"></i>Hapus</button>
                            @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete1123{{ $p->ID_PRODUK }}" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        Yakin Ingin Menghapus Data ?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                        <a href="/data-produk-delete/{{ $p->ID_PRODUK }}">
                                            <button type="button" class="btn btn-primary">
                                            
                                            <font size="3" color="white">Yes</font></button></a>
                                            
                                        </div>
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
<script src="vendors/datepicker/daterangepicker.js"></script>
<script src="vendors/lightbox/jquery.magnific-popup.min.js"></script>
<script>
$(document).ready(function (){
    $('#myTable').DataTable();
    $('.select2-example').select2();
    $('#select2').select2();

    $('input[name="daterangepicker"]').daterangepicker({
  timePicker: true,
  singleDatePicker: true,
  showDropdowns: true,
  locale: {
      format: 'DD-M-YY hh:mm A'
    }
});

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


});

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

function tampil_cant_delete(){
 swal("Oops!","Data Produk Sedang Digunakan","error");
}
</script>
</script>


<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
swal("Success!","Data Produk Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('update'))
<script>
swal("Success!","Data Produk Berhasil Di Update","success");
</script>
@endif

@if (session('delete'))
<script>
swal("Success!","Data Produk Berhasil Di Hapus","success");
</script>
@endif
@endsection