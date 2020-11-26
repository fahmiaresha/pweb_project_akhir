@extends('layouts.template')
@section('title','Pesan Supplier')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">
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
                    <li class="breadcrumb-item active" aria-current="page">Pesan Supplier</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i> Pesan Supplier</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Pesan Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/pesan-supplier-store') }}">
                        @csrf
                        <label for="nama_supplier">Supplier</label>
                        <select name="nama_supplier" id="nama_supplier" class="select2-example">
                        <option value="-" disabled="true" selected="true">Pilih Nama Supplier</option>
                        @foreach($supplier as $s)
                        <option value="{{ $s->ID_SUPPLIER }}">{{ $s->NAMA_SUPPLIER }}</option>
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
                        <th>Nama Supplier</th>
                        <th>Deskripsi Pesanan</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($catatan_order_supplier as $co)
                    <tr>
                    <td>
        <form class="post0" method="post" action="{{ url('/update-status-pesan-supplier') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $co->ID_CATATAN_ORDER_SUPPLIER }}">
          @if($co->STATUS_ORDER_SUPPLIER == 1)
          <div class="custom-control custom-switch">
          <input type="checkbox" checked class="custom-control-input" id="switch{{ $co->ID_CATATAN_ORDER_SUPPLIER }}">
          <label class="custom-control-label" for="switch{{ $co->ID_CATATAN_ORDER_SUPPLIER }}"></label>
          </div>
          <span class="badge badge-success"><font size="1">Selesai</font></span>
            
            @else
          <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="switch{{ $co->ID_CATATAN_ORDER_SUPPLIER }}">
          <label class="custom-control-label" for="switch{{ $co->ID_CATATAN_ORDER_SUPPLIER }}"></label>
          </div>
          <span class="badge badge-danger"><font size="1">Belum Selesai</font></span>    
         @endif 
      </form>
                    </td>
                    <td>{{ $co->TANGGAL_CATATAN_ORDER_SUPPLIER }}</td>
                    @foreach($supplier as $s)
                        @if($s->ID_SUPPLIER==$co->ID_SUPPLIER)
                        <td>{{$s->NAMA_SUPPLIER }}</td>
                        @endif
                    @endforeach
                    <td>{{$co->DESKRIPSI_CATATAN_ORDER_SUPPLIER	}}</td>           
                    <td>
                             <!-- Button trigger modal -->
                             <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editModal{{ $co->ID_CATATAN_ORDER_SUPPLIER }}">
                             <i class="fa fa-pencil mr-1"></i>Edit
                            </button>

                          
                            <div class="modal fade" id="editModal{{ $co->ID_CATATAN_ORDER_SUPPLIER }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pesan Supplier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                <form method="post" action="{{ url('/pesan-supplier-update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $co->ID_CATATAN_ORDER_SUPPLIER }}">

                                <label for="Kategori">Supplier</label>
                                <select name="nama_supplier" id="nama_supplier"  class="form-control">
                                @foreach($supplier as $s)
                                @if($co->ID_SUPPLIER==$s->ID_SUPPLIER)         
                                <option selected value="{{ $co->ID_SUPPLIER }}" required>{{ $s->NAMA_SUPPLIER }}</option>
                                @else
                                <option value="{{ $s->ID_SUPPLIER }}" required>{{ $s->NAMA_SUPPLIER }}</option>
                                @endif
                                @endforeach
                                </select>

                                <label for="Nama" style="margin-top:10px;">Deskripsi</label>
                                <div class="form-group">
                                <textarea class="demo-code-preview form-control mt-1" placeholder="Deskripsi Pesanan" name="deskripsi" id="message-text" value="{{ $co->DESKRIPSI_CATATAN_ORDER_SUPPLIER }}">{{ $co->DESKRIPSI_CATATAN_ORDER_SUPPLIER }}</textarea>
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
                            
            <button type="button" class="btn btn-outline-success mb-1 ml-2" data-toggle="modal" data-target="#modalwa{{ $co->ID_CATATAN_ORDER_SUPPLIER }}">
            <i class="fa fa-whatsapp mr-1"></i>Whatsapp
            </button>
                           
                    <!-- modal wa-->
            <div class="modal fade" id="modalwa{{ $co->ID_CATATAN_ORDER_SUPPLIER }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Whataspp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nomor</label>
                        <input type="text" class="form-control" placeholder="Nomor Whataspp" name="nomor" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Pesan</label>
                        <textarea class="form-control" placeholder="Deskripsi Pesan" name="pesan" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-primary">Kirim Pesan</button>
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
swal("Success!","Data Pesanan Supplier Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('update'))
<script>
swal("Success!","Data Pesanan Supplier Berhasil Di Update","success");
</script>
@endif

@if (session('update_pesan'))
<script>
swal("Success!","Status Pesanan Berhasil Di Update","success");
</script>
@endif
@endsection