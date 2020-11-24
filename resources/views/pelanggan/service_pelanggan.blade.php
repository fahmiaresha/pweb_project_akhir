@extends('layouts.template')
@section('title','Service Pelanggan')
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
                    <li class="breadcrumb-item active" aria-current="page">Service Pelanggan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i> Service Pelanggan</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Service Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/data-service-pelanggan-store') }}">
                        @csrf
                        <label for="nama_pelanggan">Pelanggan</label>
                        <select name="nama_pelanggan" id="nama_pelanggan" class="select2-example">
                        <option value="-" disabled="true" selected="true">Pilih Nama Pelanggan</option>
                        @foreach($pelanggan as $p)
                        <option value="{{ $p->ID_PELANGGAN }}">{{ $p->NAMA_PELANGGAN }}</option>
                        @endforeach
                       </select>
                       
                        <label for="Nama" style="margin-top:10px;">Nama</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="nama_sepeda" placeholder="Nama Sepeda" name="nama_sepeda" value="{{ old('nama_sepeda') }}" required>
                        </div>

                        <label for="Alamat">Deskripsi</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="deskripsi_service" placeholder="Deskripsi Service" name="deskripsi_service" value="{{ old('deskripsi_service') }}" >
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
                        <!-- <th>No</th> -->
                        <th>Nama Pelanggan</th>
                        <th>Sepeda</th>
                        <th>Deskripsi Service</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($service as $s)
                    <tr>
                    <!-- <td>{{ $loop->iteration }}</td> -->
                    @foreach($pelanggan as $p)
                        @if($p->ID_PELANGGAN==$s->ID_PELANGGAN)
                        <td>{{$p->NAMA_PELANGGAN }}</td>
                        @endif
                    @endforeach
                    <td>{{$s->NAMA_SEPEDA_SERVICE}}</td>
                    <td>{{$s->DESKRIPSI_SERVICE}}</td>           
                    <td>
                        
                            
                      
                             <!-- Button trigger modal -->
                             <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editModal{{ $s->ID_SERVICE }}">
                             <i class="fa fa-pencil mr-1"></i>Edit
                            </button>

                          
                            <div class="modal fade" id="editModal{{ $s->ID_SERVICE }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                <form method="post" action="{{ url('/data-service-pelanggan-update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $s->ID_SERVICE }}">

                                <label for="Kategori">Pelanggan</label>
                                <select name="nama_pelanggan" id="nama_pelanggan"  class="form-control">
                                @foreach($pelanggan as $p)
                                <option selected value="{{ $p->ID_PELANGGAN }}" required>{{ $p->NAMA_PELANGGAN }}</option>
                                @endforeach
                                </select>

                                <label for="Nama" style="margin-top:10px;">Nama</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" 
                                    id="nama_sepeda" placeholder="Nama Sepeda" name="nama_sepeda" value="{{ $s->NAMA_SEPEDA_SERVICE }}" required>
                                </div>

                                <label for="Alamat">Deskripsi</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" 
                                    id="deskripsi_service" placeholder="Deskripsi Service" name="deskripsi_service" value="{{ $s->DESKRIPSI_SERVICE }}" >
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
                            <a href="/data-service-pelanggan-print/{{ $s->ID_SERVICE }}">
                            <button type="button" class="btn btn-outline-success mb-1 ml-2">
                            <i class="fa fa-print mr-1"></i></i>Nota
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
    $('.select2-example').select2();
});
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
swal("Success!","Data Service Pelanggan Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('update'))
<script>
swal("Success!","Data Service Pelanggan Berhasil Di Update","success");
</script>
@endif

@if (session('delete'))
<script>
swal("Success!","Data Service Pelanggan Berhasil Di Hapus","success");
</script>
@endif
@endsection