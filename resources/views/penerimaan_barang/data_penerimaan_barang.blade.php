@extends('layouts.template')
@section('title','Data Penerimaan Barang')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">
<link rel="stylesheet" href="vendors/lightbox/magnific-popup.css" type="text/css">

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
                    <li class="breadcrumb-item active" aria-current="page">Data Penerimaan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                            <th>Tanggal Penerimaan</th>
                            <th>Tanggal Nota</th>
                            <th>Nomor Nota</th>
                            <th>Total Barang</th>
                            <th>Pegawai</th>
                            <th>Catatan</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($penerimaan_barang as $p)
                        <tr>
                            <td>{{date('d-m-Y H:i:s', strtotime($p->TANGGAL_PENERIMAAN_BARANG)) }}</td>
                            <td>{{$p->TANGGAL_NOTA}}</td>
                            <td>{{$p->NOMOR_NOTA}}</td>
                            <td>{{$p->TOTAL_PENERIMAAN_BARANG}} Barang</td>
                            <td>
                            @foreach($users as $u)
                                @if($u->id== $p->ID_USER)
                                    {{$u->name}}
                                @endif
                            @endforeach
                            </td>
                            <td>
                                @if($p->CATATAN_PENERIMAAN_BARANG==null)
                                -
                                @else
                                {{$p->CATATAN_PENERIMAAN_BARANG}}
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#lihatfoto{{$p->ID_PENERIMAAN_BARANG}}">
                                <i class="fa fa-image mr-1"></i>Lihat
                                </button>

                                <div class="modal fade" id="lihatfoto{{ $p->ID_PENERIMAAN_BARANG }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{$p->NOMOR_NOTA}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if($p->FOTO_NOTA!="")
                                                    <div class="coba" >
                                                    <center class="image-popup" href="{{ url('/foto_penerimaan_barang/'.$p->FOTO_NOTA) }}">
                                                    <img data-dismiss="modal" style="height:auto; max-width:100%; cursor:zoom-in;" src="{{ url('/foto_penerimaan_barang/'.$p->FOTO_NOTA) }}" >
                                                    </center>
                                                </div>
                                                @else
                                                    <h6 style="color:#e3bcba">Maaf , Foto tidak tersedia...<h6>
                                                @endif
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-info mb-1 ml-2" data-toggle="modal" data-target="#modaldetail{{$p->ID_PENERIMAAN_BARANG}}">
                                <i class="fa fa-info-circle mr-1"></i>Detail
                                </button>

                                <div class="modal fade" id="modaldetail{{$p->ID_PENERIMAAN_BARANG}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Penerimaan Barang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="ti-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1"><strong>Pegawai</strong></label>
                                            <div class="coba">
                                            @foreach($users as $u)
                                                @if($u->id== $p->ID_USER)
                                                    {{$u->name}}
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>

                                        <div class="form-row">

                                        <div class="form-group col-md-3 "> 
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1"><strong>Tanggal Penerimaan</strong></label>
                                                <div class="coba">
                                                {{date('d-m-Y H:i:s', strtotime($p->TANGGAL_PENERIMAAN_BARANG)) }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1"><strong>Tanggal Nota</strong></label>
                                                <div class="coba">
                                                {{$p->TANGGAL_NOTA}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1"><strong>Nomor Nota</strong></label>
                                                <div class="coba">
                                                {{$p->NOMOR_NOTA}}
                                                </div>
                                            </div>
                                        </div>

                                        

                                       
                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1"><strong>Barang Diterima</strong></label>
                                                <div class="coba">
                                                {{$p->TOTAL_PENERIMAAN_BARANG}} Barang
                                                </div>
                                            </div>
                                        </div>
                                        

                                        

                                        </div>

                                        <label for="exampleFormControlTextarea1"><strong>Daftar Penerimaan</strong></label>
                                        <div class="table-responsive mt-2">
                                        <table class="table table-active table-hover">
                                        <thead>
                                            <tr>
                                                <center>
                                                <th>#</th>
                                                <th>Supplier</th>
                                                <th>Tanggal Pembelian</th>
                                                <th>Kategori</th>
                                                <th>Produk</th>
                                                <th>Stok lama</th>
                                                <th>Barang Diterima</th>
                                                <th>Stok Baru</th>
                                                </center>
                                            </tr>
                                        </thead>
                                        @php $nomer=1; @endphp
                                        @foreach($detail_penerimaan_barang as $dp)
                                            @if($p->ID_PENERIMAAN_BARANG==$dp->ID_PENERIMAAN_BARANG)
                                            <tr>
                                                <td>@php echo $nomer; @endphp</td>
                                                <td>
                                                @foreach($supplier as $s)
                                                    @if($s->ID_SUPPLIER==$dp->ID_SUPPLIER)
                                                        {{$s->NAMA_SUPPLIER}} - {{$s->ALAMAT_SUPPLIER}}
                                                    @endif
                                                @endforeach
                                                </td>
                                                <td>{{$dp->TANGGAL_PEMBELIAN_PRODUK}}</td>
                                                @foreach($product as $pr)
                                                    @if($dp->ID_PRODUK==$pr->ID_PRODUK)
                                                        @foreach($kategori_produk as $kp)
                                                            @if($pr->ID_KATEGORI_PRODUK==$kp->ID_KATEGORI_PRODUK)
                                                            <td>{{$kp->NAMA_KATEGORI_PRODUK}} </td>
                                                            @endif
                                                        @endforeach
                                                    <td>{{$pr->NAMA_PRODUK}}</td>
                                                    @endif
                                                @endforeach
                                            
                                                <td >{{$dp->STOK_LAMA_PRODUK}} Barang</td>
                                                <td >{{$dp->JUMLAH_PRODUK_DITERIMA}} Barang</td>
                                                <td >{{$dp->STOK_BARU_PRODUK}} Barang</td>
                                            </tr>
                                                @php $nomer++; @endphp 
                                            @endif
                                            
                                        @endforeach
                                        </table>
                                        </div>
                                        

                                        <label for="exampleFormControlTextarea1"><strong>Catatan : 
                                            @if($p->CATATAN_PENERIMAAN_BARANG==null)
                                            -
                                            @else
                                            {{$p->CATATAN_PENERIMAAN_BARANG}}
                                            @endif
                                            </strong>
                                            </label>
                                        </div>
                                        <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                        </div> -->
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

<script>
$(document).ready(function (){
    $('#myTable').DataTable({
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
</script>
@endsection