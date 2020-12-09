@extends('layouts.template')
@section('title','Data Pelanggan')
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
                    <li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i> Data Pelanggan</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/data-pelanggan-store') }}">
                        @csrf
                        <label for="Kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="select2-example">
                        <option disabled="true" selected="true" required>Pilih Kategori</option>
                        @foreach($kategori_pelanggan as $kp)
                        <option value="{{ $kp->ID_KATEGORI_PELANGGAN }}" required>{{ $kp->NAMA_KATEGORI_PELANGGAN }}</option>
                        @endforeach
                       </select>
                       
                      

                        <label for="Nama" style="margin-top:10px;">Nama</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="nama" placeholder="Nama Lengkap" name="nama" value="{{ old('nama') }}" required>
                        </div>

                        <label for="Alamat">Alamat</label>
                        <div class="form-group">
                            <input type="text" class="demo-code-preview form-control mt-1" 
                            id="alamat" placeholder="Alamat Lengkap" name="alamat" value="{{ old('alamat') }}" >
                        </div>

                        <label for="Telp">Telepon</label>
                        <div class="form-group">
                            <input type="number" class="demo-code-preview form-control mt-1" 
                            id="telp" placeholder="Telepon" name="telp" value="{{ old('telp') }}" >
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
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($pelanggan as $p)
                    <tr>
                    <!-- <td>{{ $loop->iteration }}</td> -->
                    @foreach($kategori_pelanggan as $kp)
                        @if($kp->ID_KATEGORI_PELANGGAN==$p->ID_KATEGORI_PELANGGAN)
                        <td>{{ $kp->NAMA_KATEGORI_PELANGGAN }}</td>
                        @endif
                    @endforeach
                    <td>{{$p->NAMA_PELANGGAN}}</td>
                    <td>{{$p->ALAMAT_PELANGGAN}}</td>           
                    <td>{{$p->TELP_PELANGGAN}}</td>
                    <td>
                        
                            
                      
                             <!-- Button trigger modal -->
                             <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editModal{{ $p->ID_PELANGGAN }}">
                             <i class="fa fa-pencil mr-1"></i>Edit
                            </button>

                          
                            <div class="modal fade" id="editModal{{ $p->ID_PELANGGAN }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                <form method="post" action="{{ url('/data-pelanggan-update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $p->ID_PELANGGAN }}">

                                <label for="Kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control">
                                @foreach($kategori_pelanggan as $kp)
                                @if($kp->ID_KATEGORI_PELANGGAN==$p->ID_KATEGORI_PELANGGAN)  
                                <option selected value="{{ $p->ID_KATEGORI_PELANGGAN }}" required>{{ $kp->NAMA_KATEGORI_PELANGGAN }}</option>
                                @else
                                <option value="{{ $kp->ID_KATEGORI_PELANGGAN }}" required>{{ $kp->NAMA_KATEGORI_PELANGGAN }}</option>
                                @endif
                                @endforeach
                                </select>

                                <label for="Nama" style="margin-top:10px;">Nama</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" 
                                    id="nama" placeholder="Nama Lengkap" name="nama" value="{{ $p->NAMA_PELANGGAN}}" required>
                                </div>

                                        <label for="Alamat">Alamat</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" 
                                    id="alamat" placeholder="Alamat Lengkap" name="alamat" value="{{ $p->ALAMAT_PELANGGAN}}" >
                                </div>

                                <label for="Telp">Telepon</label>
                                <div class="form-group">
                                    <input type="number" class="demo-code-preview form-control mt-1" 
                                    id="telp" placeholder="Telepon" name="telp" value="{{ $p->TELP_PELANGGAN}}" >
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
                            @foreach($service as $s)
                                @if($s->ID_PELANGGAN==$p->ID_PELANGGAN)
                                    @php $x=1; @endphp
                                @endif
                            @endforeach

                            @foreach($catatan_pre_order_pelanggan as $po)
                                @if($po->ID_PELANGGAN==$p->ID_PELANGGAN)
                                    @php $x=1; @endphp
                                @endif
                            @endforeach

                            <!-- tutup Button trigger modal edit -->

                            @if($x==0)
                                      <!-- Button trigger modal -->
                                      <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" 
                                        data-target="#delete1123{{ $p->ID_PELANGGAN }}">
                                        <i class="fa fa-trash mr-1"></i>Hapus</button>
                            @else 
                            <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" 
                                        data-target="#delete1123" onclick="tampil_cant_delete()">
                                        <i class="fa fa-trash mr-1"></i>Hapus</button>                          
                            @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete1123{{ $p->ID_PELANGGAN }}" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <a href="/data-pelanggan-delete/{{ $p->ID_PELANGGAN }}">
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
 swal("Oops!","Data Pelanggan Sedang Digunakan","error");
}
</script>
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
swal("Success!","Data Pelanggan Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('update'))
<script>
swal("Success!","Data Pelanggan Berhasil Di Update","success");
</script>
@endif

@if (session('delete'))
<script>
swal("Success!","Data Pelanggan Berhasil Di Hapus","success");
</script>
@endif
@endsection