@extends('layouts.template')
@section('title','Data Penjualan')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

@endsection

@section('content')



<div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Penjualan</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Penjualan</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Penjualan</li>
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
                        <th>Nota</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Pelanggan</th>
                        <th>Kasir</th>  
                        <th>Total Bayar</th>
                        <!-- <th>Catatan</th> -->
                        <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($penjualan as $p)
                    <tr>
                    <td>NTA-{{$p->ID_PENJUALAN}}</td>
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
                    <td>
                    @foreach($users as $u)
                        @if($u->id== $p->ID_USER)
                            {{$u->name}}
                        @endif
                    @endforeach
                    </td>
                    <td>Rp. {{ number_format($p->TOTAL_PENJUALAN)}}</td>
                    <!-- <td>
                    @if($p->CATATAN_PENJUALAN==null)
                    -
                    @else
                    {{$p->CATATAN_PENJUALAN}}
                    @endif
                    </td>  -->
                    <td>

                    <button type="button" class="btn btn-outline-info mb-1 ml-2" data-toggle="modal" data-target="#modaldetail{{$p->ID_PENJUALAN}}">
                    <i class="fa fa-info-circle mr-1"></i>Detail
                    </button>

                    <div class="modal fade" id="modaldetail{{$p->ID_PENJUALAN}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="ti-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">

                        <div class="form-group">
                        <label for="exampleFormControlTextarea1"><strong>Kasir</strong></label>
                         <div class="coba">
                         @foreach($users as $u)
                            @if($u->id== $p->ID_USER)
                                {{$u->name}}
                            @endif
                        @endforeach
                         </div>
                        </div>

                        <div class="form-row">
                        <div class="form-group col-md-3">
                            <div class="form-group">
                            <label for="exampleFormControlTextarea1"><strong>No. Invoice</strong></label>
                            <div class="coba">
                            NTA-{{$p->ID_PENJUALAN}}
                            </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div class="form-group">
                            <label for="exampleFormControlTextarea1"><strong>Tanggal</strong></label>
                            <div class="coba">
                            {{date('d-m-Y H:i:s', strtotime($p->TANGGAL_PENJUALAN)) }}
                            </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3 "> 
                            <div class="form-group">
                            <label for="exampleFormControlTextarea1"><strong>Pelanggan</strong></label>
                            <div class="coba">
                            @if($p->ID_PELANGGAN==null)
                            Umum
                            @else
                                @foreach($pelanggan as $pl)
                                    @if($p->ID_PELANGGAN==$pl->ID_PELANGGAN)
                                        {{$pl->NAMA_PELANGGAN}}
                                    @endif
                                @endforeach
                            @endif  
                            </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div class="form-group">
                            <label for="exampleFormControlTextarea1"><strong>Kategori</strong></label>
                            <div class="coba">
                             @foreach($kategori_pelanggan as $kp)
                        @if($p->KATEGORI_PELANGGAN_PENJUALAN==$kp->ID_KATEGORI_PELANGGAN)
                        {{$kp->NAMA_KATEGORI_PELANGGAN}}
                        @endif
                        @endforeach
                            </div>
                            </div>
                        </div>
                        

                        

                        </div>

                        <label for="exampleFormControlTextarea1"><strong>Daftar Pembelian</strong></label>
                        <div class="table-responsive mt-2">

                        <table class="table table-active table-hover">
                        <thead>
                        <tr>
                        <center>
                        
                          <th>#</th>
                          <th>Kategori</th>
                          <th>Produk</th>
                          <th>Harga</th>
                          <th>Jumlah</th>
                          <th>Total</th>
                          </center>
                        </tr>
                        </thead>
                        
                        @php $nomer=1; @endphp
                        @foreach($detail_penjualan as $dp)
                            @if($p->ID_PENJUALAN==$dp->ID_PENJUALAN)
                            <tr>
                                <td>@php echo $nomer; @endphp</td>
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
                               
                                <td>Rp. {{ number_format($dp->HARGA_PRODUK)}}</td>
                                <td>
                                <center>  
                                {{$dp->JUMLAH_PRODUK}}
                                </center>
                                </td>
                                <td>Rp. {{ number_format($dp->TOTAL_HARGA_PRODUK)}}</td> 
                            </tr>
                                @php $nomer++; @endphp 
                            @endif
                            
                        @endforeach
                        </table>
                        </div>
                        
                        <div class="form-row">
                        <div class="form-group col-md-6">
                        </div>
                        <div class="form-group col-md-6">

                        <div class="table-responsive mt-2">
                        <table class="table table-borderless table-active table-hover">
                                                <tbody>
                                                <tr>
                                                <td><strong>Total Bayar<strong></td>
                                                <td>Rp. {{ number_format($p->TOTAL_PENJUALAN)}}</td>
                                                </tr>
                                                <tr>
                                                <td><strong>Cash</strong></td>
                                                <td>Rp. {{ number_format($p->CASH_PELANGGAN)}}</td>
                                                </tr>
                                                <tr>
                                                <td><strong>Change <strong> </td>
                                                <td>Rp. {{ number_format($p->CHANGE_PELANGGAN)}}</td>
                                                </tr>
                                                </tbody>
                        </table>
                        </div>

                        </div>
                        </div>

                        <label for="exampleFormControlTextarea1"><strong>Catatan : 
                            @if($p->CATATAN_PENJUALAN==null)
                            -
                            @else
                            {{$p->CATATAN_PENJUALAN}}
                            @endif </strong></label>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                            </button>
                        </div> -->
                        </div>
                    </div>
                    </div>
                                    

                    <a href="/invoice-penjualan/{{$p->ID_PENJUALAN}}" target="_blank">
                            <button type="button" class="btn btn-outline-success mb-1 ml-2">
                            <i class="fa fa-print mr-1"></i>Nota
                            </button>
                    </a>
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
});

</script>
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@endsection