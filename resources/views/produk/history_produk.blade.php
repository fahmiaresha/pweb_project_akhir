@extends('layouts.template')
@section('title','History Produk')
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
                    <li class="breadcrumb-item active" aria-current="page">History Produk</li>
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
                        <td>Tanggal Diubah</td>
                        <th>Tanggal Pembelian</th>
                        <th>Kategori</th>
                        <th>Supplier</th>     
                        <th>Produk</th>
                        <th>Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Reseller</th>
                        <th>Harga Jual</th>
                        <th>Deksripsi</th>
                        <th>Pegawai</th>
                        <th>History</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($history_produk as $hp)
                        <tr>
                        <td>{{date('d-m-Y H:i:s', strtotime($hp->TANGGAL_DIUBAH)) }}</td>
                        <td>{{$hp->TANGGAL_PEMBELIAN_PRODUK}}</td>
                        @foreach($kategori_produk as $kt)
                            @if($kt->ID_KATEGORI_PRODUK==$hp->ID_KATEGORI_PRODUK)
                            <td>{{$kt->NAMA_KATEGORI_PRODUK}}</td> 
                            @endif
                        @endforeach
                        @foreach($supplier as $s)
                            @if($s->ID_SUPPLIER==$hp->ID_SUPPLIER)
                            <td>{{$s->NAMA_SUPPLIER}}</td>   
                            @endif
                        @endforeach
                        <td>{{$hp->NAMA_PRODUK}}</td>
                        <td>{{$hp->STOK_PRODUK}}</td>
                        <td>Rp. {{number_format($hp->HARGA_BELI_PRODUK)}}</td>
                        <td>Rp. {{number_format($hp->HARGA_JUAL_RESELLER_PRODUK)}}</td>
                        <td>Rp. {{number_format($hp->HARGA_JUAL_PELANGGAN_PRODUK)}}</td>
                        <td>{{$hp->DESKRIPSI_PRODUK}}</td>
                        @foreach($user as $s)
                            @if($s->id==$hp->ID_PEGAWAI)
                            <td>{{$s->name}}</td>
                            @endif
                        @endforeach
                        <td>
                            <button type="button" class="btn btn-outline-info mb-1 ml-2" data-toggle="modal" data-target="#detail{{ $hp->ID_HISTORY_PRODUK }}">
                            <i class="fa fa-info-circle mr-1"></i>Detail
                            </button>

                            <div class="modal fade" id="detail{{ $hp->ID_HISTORY_PRODUK }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">History</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="ti-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach($history_sebelum_perubahan_produk as $hspr)
                                                @if($hp->ID_HISTORY_PRODUK==$hspr->ID)
                                                    <label for="Nama">Tanggal Pembelian</label>
                                                    <div class="form-group">
                                                    <input type="text" class="form-control" class="demo-code-preview form-control mt-1"  value="{{$hspr->TANGGAL_PEMBELIAN_PRODUK}}" readonly>
                                                    </div>
                                                    @foreach($kategori_produk as $kt)
                                                        @if($kt->ID_KATEGORI_PRODUK==$hspr->ID_KATEGORI_PRODUK)
                                                            <label for="Nama">Kategori</label>
                                                            <div class="form-group">
                                                            <input type="text" class="form-control" class="demo-code-preview form-control mt-1"  value="{{$kt->NAMA_KATEGORI_PRODUK}}" readonly>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    @foreach($supplier as $s)
                                                        @if($s->ID_SUPPLIER==$hspr->ID_SUPPLIER)
                                                            <label for="Nama">Supplier</label>
                                                            <div class="form-group">
                                                            <input type="text" class="form-control" class="demo-code-preview form-control mt-1"  value="{{$s->NAMA_SUPPLIER}} " readonly>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                            <label for="Nama">Produk</label>
                                                            <div class="form-group">
                                                            <input type="text" class="form-control" class="demo-code-preview form-control mt-1"  value="{{$hspr->NAMA_PRODUK}} " readonly>
                                                            </div>

                                                            <label for="Nama">Stok</label>
                                                            <div class="form-group">
                                                            <input type="text" class="form-control" class="demo-code-preview form-control mt-1"  value="{{$hspr->STOK_PRODUK}} " readonly>
                                                            </div>

                                                            <label for="Nama">Harga Beli</label>
                                                            <div class="form-group">
                                                            <input type="text" class="form-control" class="demo-code-preview form-control mt-1"  value="Rp. {{number_format($hspr->HARGA_BELI_PRODUK)}} " readonly>
                                                            </div>

                                                            <label for="Nama">Harga Reseller</label>
                                                            <div class="form-group">
                                                            <input type="text" class="form-control" class="demo-code-preview form-control mt-1"  value="Rp. {{number_format($hspr->HARGA_JUAL_RESELLER_PRODUK)}} " readonly>
                                                            </div>

                                                            <label for="Nama">Harga Jual</label>
                                                            <div class="form-group">
                                                            <input type="text" class="form-control" class="demo-code-preview form-control mt-1"  value="Rp. {{number_format($hspr->HARGA_JUAL_PELANGGAN_PRODUK)}} " readonly>
                                                            </div>

                                                            <label for="Nama">Deskripsi</label>
                                                            <div class="form-group">
                                                            <input type="text" class="form-control" class="demo-code-preview form-control mt-1"  value="{{$hspr->DESKRIPSI_PRODUK}} " readonly>
                                                            </div>   
                                                @endif
                                            @endforeach

                                        </div>
                                            <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Kirim Pesan</button>
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
<script src="vendors/datepicker/daterangepicker.js"></script>
<script src="vendors/lightbox/jquery.magnific-popup.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

<script>
$(document).ready(function (){
    $('#myTable').DataTable();

});
</script>
@endsection