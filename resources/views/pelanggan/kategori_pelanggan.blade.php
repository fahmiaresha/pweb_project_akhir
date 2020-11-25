@extends('layouts.template')
@section('title',' Kategori Pelanggan')
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
                    <li class="breadcrumb-item active" aria-current="page">Kategori Pelanggan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i> Kategori Pelanggan</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Kategori Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/data-kategori-pelanggan-store') }}">
                        @csrf
                        <label for="Nama" style="margin-top:10px;">Kategori Pelanggan</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="kategori_pelanggan" placeholder="Nama Kategori Pelanggan" name="kategori_pelanggan" value="{{ old('kategori_pelanggan') }}" required>
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
                        <th>Kategori Pelanggan</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                @foreach($kategori_pelanggan as $kp)
                    <tr>
                    <td>{{$kp->NAMA_KATEGORI_PELANGGAN}}</td>
                    <td>
                             <!-- Button trigger modal edit -->
                             <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editModal{{$kp->ID_KATEGORI_PELANGGAN}}">
                             <i class="fa fa-pencil mr-1"></i>Edit
                            </button>

                          
                            <div class="modal fade" id="editModal{{$kp->ID_KATEGORI_PELANGGAN}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori Pelanggan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                <form method="post" action="{{ url('/data-kategori-pelanggan-update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{$kp->ID_KATEGORI_PELANGGAN}}">

                                <label for="Nama" style="margin-top:10px;">Kategori Pelanggan</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" 
                                    id="kategori_pelanggan" placeholder="Nama Kategori Pelanggan" name="kategori_pelanggan" value="{{$kp->NAMA_KATEGORI_PELANGGAN}}" required>
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


                            @php $x=0; @endphp
                            @foreach($pelanggan as $p)
                                @if($kp->ID_KATEGORI_PELANGGAN  == $p-> ID_KATEGORI_PELANGGAN)
                                    @php $x=1; @endphp
                                @endif
                            @endforeach

                            @if($x==0)
                                      <!-- Button trigger modal -->
                                      <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" 
                                        data-target="#delete1123{{$kp->ID_KATEGORI_PELANGGAN}}">
                                        <i class="fa fa-trash mr-1"></i>Hapus</button>
                            @else 
                            <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" 
                                        data-target="#delete1123" onclick="tampil_cant_delete()">
                                        <i class="fa fa-trash mr-1"></i>Hapus</button>                          
                            @endif           

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete1123{{$kp->ID_KATEGORI_PELANGGAN}}" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <a href="/data-kategori-pelanggan-delete/{{$kp->ID_KATEGORI_PELANGGAN}}">
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

<script>
$(document).ready(function (){
    $('#myTable').DataTable();
    $('.select2-example').select2();
});

function tampil_cant_delete(){
 swal("Oops!","Data Kategori Sedang Digunakan","error");
}
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
swal("Success!","Data Kategori Pelanggan Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('update'))
<script>
swal("Success!","Data Kategori Pelanggan Berhasil Di Update","success");
</script>
@endif

@if (session('delete'))
<script>
swal("Success!","Data Kategori Pelanggan Berhasil Di Hapus","success");
</script>
@endif
@endsection