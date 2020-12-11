@extends('layouts.template')
@section('title','Data Supplier')
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
                    <li class="breadcrumb-item active" aria-current="page">Data Supplier</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i> Data Supplier</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/data-supplier-store') }}">
                        @csrf
                        <label for="Nama" style="margin-top:10px;">Nama</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Nama Supplier" name="nama_supplier" value="{{ old('nama_supplier') }}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Pemasok Barang</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Nama Barang" name="pemasok_barang" value="{{ old('pemasok_barang') }}" required>
                        </div>

                        <label for="Alamat">Alamat</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="alamat_supplier" placeholder="Alamat Supplier" name="alamat_supplier" value="{{ old('alamat_supplier') }}" required>
                        </div>

                        <label for="Telp">Telepon</label>
                        <div class="form-group">
                            <input type="number" class="demo-code-preview form-control mt-1" 
                            id="telepon_supplier" placeholder="Telepon Supplier" name="telepon_supplier" value="{{ old('telepon_supplier') }}" >
                        </div>

                        <label for="Telp">Email</label>
                        <div class="form-group">
                            <input type="email" class="demo-code-preview form-control mt-1" 
                            id="email_supplier" placeholder="example@gmail.com" name="email_supplier" value="{{ old('email_supplier') }}" >
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
                        <th>Nama</th>
                        <th>Pemasok Barang</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Email</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($supplier as $sp)
                    <tr>
                    <!-- <td>{{ $loop->iteration }}</td> -->
                   
                    <td>{{$sp->NAMA_SUPPLIER}}</td>
                    <td>{{$sp->NAMA_PEMASOK_BARANG}}</td>
                    <td>{{$sp->ALAMAT_SUPPLIER}}</td>
                    <td>{{$sp->TELP_SUPPLIER}}</td>           
                    <td>{{$sp->EMAIL_SUPPLIER}}</td>
                    <td>
                             <!-- Button trigger modal -->
                             <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editModal{{$sp->ID_SUPPLIER}}">
                             <i class="fa fa-pencil mr-1"></i>Edit
                            </button>

                          
                            <div class="modal fade" id="editModal{{$sp->ID_SUPPLIER}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                <form method="post" action="{{ url('/data-supplier-update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{$sp->ID_SUPPLIER}}">

                                <label for="Nama" style="margin-top:10px;">Nama</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Nama Supplier" name="nama_supplier" value="{{$sp->NAMA_SUPPLIER}}" required>
                        </div>

                        <label for="Nama" style="margin-top:10px;">Pemasok Barang</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Nama Barang" name="pemasok_barang" value="{{$sp->NAMA_PEMASOK_BARANG}}" required>
                        </div>

                        <label for="Alamat">Alamat</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="alamat_supplier" placeholder="Alamat Supplier" name="alamat_supplier" value="{{$sp->ALAMAT_SUPPLIER}}" required>
                        </div>

                        <label for="Telp">Telepon</label>
                        <div class="form-group">
                            <input type="number" class="demo-code-preview form-control mt-1" 
                            id="telepon_supplier" placeholder="Telepon Supplier" name="telepon_supplier" value="{{$sp->TELP_SUPPLIER}}" >
                        </div>

                        <label for="Telp">Email</label>
                        <div class="form-group">
                            <input type="email" class="demo-code-preview form-control mt-1" 
                            id="email_supplier" placeholder="example@gmail.com" name="email_supplier" value="{{$sp->EMAIL_SUPPLIER}}" >
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
                            @foreach($catatan_order_supplier as $co)
                                @if($co->ID_SUPPLIER==$sp->ID_SUPPLIER)
                                    @php $x=1; @endphp
                                @endif
                            @endforeach

                            @foreach($nota_supplier as $ns)
                                @if($ns->ID_SUPPLIER==$sp->ID_SUPPLIER)
                                    @php $x=1; @endphp
                                @endif
                            @endforeach

                            @if($x==0)
                                      <!-- Button trigger modal -->
                                      <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" 
                                        data-target="#delete1123{{$sp->ID_SUPPLIER}}">
                                        <i class="fa fa-trash mr-1"></i>Hapus</button>

                            @else 
                            <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" 
                                        data-target="#delete1123" onclick="tampil_cant_delete()">
                                        <i class="fa fa-trash mr-1"></i>Hapus</button>                          
                            @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete1123{{$sp->ID_SUPPLIER}}" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <a href="/data-supplier-delete/{{$sp->ID_SUPPLIER}}">
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
 swal("Oops!","Data Supplier Sedang Digunakan","error");
}
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
swal("Success!","Data Supplier Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('update'))
<script>
swal("Success!","Data Supplier Berhasil Di Update","success");
</script>
@endif

@if (session('delete'))
<script>
swal("Success!","Data Supplier Berhasil Di Hapus","success");
</script>
@endif
@endsection