@extends('layouts.template')
@section('title','Data Whatsapp')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

@endsection

@section('content')



<div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Whatsapp</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <!-- <li class="breadcrumb-item">
                        <a href="#">Pelanggan</a>
                    </li> -->
                    <li class="breadcrumb-item active" aria-current="page">Data Whatsapp</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i>Pesan Whatsapp</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Whatsapp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/whatsapp-store') }}">
                        @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Kategori</label>
                        <input type="text" class="form-control" placeholder="Kategori Whatsapp" name="kategori" id="recipient-name" required>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nomor</label>
                        <input type="text" class="form-control" placeholder="Nomor Whatsapp" name="nomor_whatsapp" id="recipient-name"required>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Pesan</label>
                        <textarea class="form-control" placeholder="Deskripsi Pesan" name="pesan_whatsapp" id="message-text" required></textarea>
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
                <table id="myTable" class="table table-striped table-bordered table-hover ">
                    <thead>
                        <tr>
                        <!-- <th>No</th> -->
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Nomor</th>
                        <th>Pesan</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($whatsapp as $w)
                    <tr>
                    <td>{{date('d-m-Y H:i:s', strtotime($w->TANGGAL_WHATSAPP)) }}</td>
                    <td>{{$w->KATEGORI_WHATSAPP}}</td>           
                    <td>{{$w->NO_WHATSAPP}}</td>
                    <td>{{$w->PESAN_WHATSAPP}}</td>
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


</script>
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
swal("Success!","Data Whatsapp Berhasil Di Tambahkan","success");
</script>
@endif

@endsection