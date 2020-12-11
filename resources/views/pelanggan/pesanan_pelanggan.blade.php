@extends('layouts.template')
@section('title','Pesanan Pelanggan')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

@endsection

@section('content')



<div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Pelanggan</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Pelanggan</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan Pelanggan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i> Pesanan Pelanggan</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Pesanan Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/pesanan-pelanggan-store') }}">
                        @csrf
                        <label for="nama_pelanggan">Pelanggan</label>
                        <select name="nama_pelanggan" id="nama_pelanggan" class="select2-example">
                        <option value="-" disabled="true" selected="true">Pilih Nama Pelanggan</option>
                        @foreach($pelanggan as $p)
                        <option value="{{ $p->ID_PELANGGAN }}">{{ $p->NAMA_PELANGGAN }} - {{ $p->ALAMAT_PELANGGAN }}</option>
                        @endforeach
                       </select>
                       
                        <label for="Nama" style="margin-top:10px;">Deskripsi</label>
                        <div class="form-group">
                        <textarea class="demo-code-preview form-control mt-1" placeholder="Deskripsi Pesanan" name="deskripsi" id="message-text" value="{{ old('deskripsi') }}"></textarea>
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
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Deskripsi Pesanan</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($pre_order as $po)
                    <tr>
                    <td>
        <form class="post0" method="post" action="{{ url('/update-status-pesan-pelanggan') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}">
          @if($po->STATUS_PRE_ORDER == 1)
          <div class="custom-control custom-switch">
          <input type="checkbox" checked class="custom-control-input" id="switch{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}">
          <label class="custom-control-label" for="switch{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}"></label>
          </div>
          <span class="badge badge-success"><font size="1">Selesai</font></span>
            
            @else
          <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="switch{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}">
          <label class="custom-control-label" for="switch{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}"></label>
          </div>
          <span class="badge badge-danger"><font size="1">Belum Selesai</font></span>    
         @endif 
      </form>
                    </td>
                    <td>
                    {{date('d-m-Y H:i:s', strtotime($po->TANGGAL_CATATAN_PRE_ORDER_PELANGGAN)) }}
                    </td>
                    @foreach($pelanggan as $p)
                        @if($p->ID_PELANGGAN==$po->ID_PELANGGAN)
                        <td>{{$p->NAMA_PELANGGAN }} - {{ $p->ALAMAT_PELANGGAN }}</td>
                        @endif
                    @endforeach
                    <td>{{$po->DESKRIPSI_CATATAN_PRE_ODER_PELANGGAN}}</td>           
                    <td>
                             <!-- Button trigger modal -->
                             <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editModal{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}">
                             <i class="fa fa-pencil mr-1"></i>Edit
                            </button>

                          
                            <div class="modal fade" id="editModal{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pesanan Pelanggan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                <form method="post" action="{{ url('/pesanan-pelanggan-update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}">

                                <label for="Kategori">Pelanggan</label>
                                <select name="nama_pelanggan" id="nama_pelanggan"  class="form-control">
                                @foreach($pelanggan as $p)
                                @if($po->ID_PELANGGAN==$p->ID_PELANGGAN)         
                                <option selected value="{{ $po->ID_PELANGGAN }}" required>{{ $p->NAMA_PELANGGAN }} - {{ $p->ALAMAT_PELANGGAN }}</option>
                                @else
                                <option value="{{ $p->ID_PELANGGAN }}" required>{{ $p->NAMA_PELANGGAN }} - {{ $p->ALAMAT_PELANGGAN }}</option>
                                @endif
                                @endforeach
                                </select>

                                <label for="Nama" style="margin-top:10px;">Deskripsi</label>
                                <div class="form-group">
                                <textarea class="demo-code-preview form-control mt-1" placeholder="Deskripsi Pesanan" name="deskripsi" id="message-text" value="{{ $po->DESKRIPSI_CATATAN_PRE_ODER_PELANGGAN }}">{{ $po->DESKRIPSI_CATATAN_PRE_ODER_PELANGGAN }}</textarea>
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

                            <!-- tutup Button trigger modal edit -->
                            
            <button type="button" class="btn btn-outline-success mb-1 ml-2" data-toggle="modal" data-target="#modalwa{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}">
            <i class="fa fa-whatsapp mr-1"></i>Whatsapp
            </button>
                           
                    <!-- modal wa-->
            <div class="modal fade" id="modalwa{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Whataspp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('/pesanan-pelanggan-send-wa') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $po->ID_CATATAN_PRE_ORDER_PELANGGAN }}">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nomor</label>
                        @foreach($pelanggan as $p)
                                @if($po->ID_PELANGGAN==$p->ID_PELANGGAN)
                                <input type="text" class="form-control" placeholder="Nomor Whatsapp" name="nomor_whatsapp" id="recipient-name" value="{{$p->TELP_PELANGGAN}}" required>
                                @endif
                        @endforeach 
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Pesan</label>
                        <textarea class="form-control" placeholder="Deskripsi Pesan" name="pesan_whatsapp" id="message-text" required>{{$po->DESKRIPSI_CATATAN_PRE_ODER_PELANGGAN}}</textarea>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                    <button type="submit"  class="btn btn-primary">Kirim Pesan</button>
                    </form>
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
});
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
swal("Success!","Data Pesanan Pelanggan Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('update'))
<script>
swal("Success!","Data Pesanan Pelanggan Berhasil Di Update","success");
</script>
@endif

@if (session('update_pesan'))
<script>
swal("Success!","Status Pesanan Berhasil Di Update","success");
</script>
@endif
@endsection