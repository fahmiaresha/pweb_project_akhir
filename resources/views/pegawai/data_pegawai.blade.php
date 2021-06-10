@extends('layouts.template')
@section('title','Data Pegawai')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Pegawai</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <!-- <li class="breadcrumb-item">
                        <a href="#">Pegawai</a>
                    </li> -->
                    <li class="breadcrumb-item active" aria-current="page">Data Pegawai</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal"  data-target="#coba">
            <i class="fa fa-plus-circle mr-2"></i> Data Pegawai</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/store-pegawai') }}">
                        @csrf
                        <label for="Kategori">Jabatan</label>
                        <select name="jabatan" id="jabatan" required class="select2-example">
                        <option disabled="true" selected="true" value="" >Pilih Jabatan</option>
                        @foreach($jabatan as $j)
                        <option value="{{ $j->ID_JABATAN }}" required>{{ $j->NAMA_JABATAN }}</option>
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

                        <label for="Alamat">Email</label>
                        <div class="form-group">
                            <input type="email" class="demo-code-preview form-control mt-1" 
                            id="alamat" placeholder="example@gmail.com" name="email" value="{{ old('email') }}" required>
                        </div>

                        <label for="Telp">Telepon</label>
                        <div class="form-group">
                            <input type="number" class="demo-code-preview form-control mt-1" 
                            id="telp" placeholder="Telepon" name="telpon" value="{{ old('telp') }}" >
                        </div>

                        <label for="Alamat">Password</label>
                        <div class="form-group">
                            <input type="password" class="demo-code-preview form-control mt-1" 
                            id="password" placeholder="Password" name="password" value="{{ old('password') }}" required>
                        </div>

                        <label for="Alamat">Ulangi Password</label>
                        <div class="form-group">
                            <input type="password" class="demo-code-preview form-control mt-1" 
                            id="repeat_password" onkeyup="cekPass()" placeholder="Ulangi Password" name="repeat_password" value="{{ old('password') }}" required>
                            <strong><p id="error" class="mt-1"></p></strong>
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
                <table id="myTable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                        <!-- <th>No</th> -->
                        <th>Status</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telp</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($pegawai as $p)
                    <tr>
                    <td>
                      <form class="post0" method="post" action="{{ url('/update-status-pegawai') }}">
                        @csrf
                        <input type="hidden" name="id_user" value="{{ $p->id }}">
                        @if($p->status_akun==1)
                        <div class="custom-control custom-switch">
                        <input type="checkbox" checked class="custom-control-input" id="switch{{ $p->id }}">
                        <label class="custom-control-label" for="switch{{ $p->id }}"></label>
                        </div>
                        <span class="badge badge-success"><font size="1">Aktif</font></span>    
                        @else
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="switch{{ $p->id }}">
                        <label class="custom-control-label" for="switch{{ $p->id }}"></label>
                        </div>
                        <span class="badge badge-danger"><font size="1">Non-Aktif</font></span>    
                        @endif 
                      </form>
                    </td>
                    <td>{{$p->name}}</td>
                    <td>
                        @foreach($jabatan as $j)
                            @if($p->ID_JABATAN==$j->ID_JABATAN)
                                {{$j->NAMA_JABATAN}}      
                            @endif
                        @endforeach
                    </td>
                    <td>{{$p->alamat_user}}</td>
                    <td>{{$p->email}}</td>
                    <td>{{$p->telp_user}}</td>
                    <td>
                             <!-- Button trigger modal -->
                             <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal" data-target="#editModal{{$p->id}}">
                             <i class="far fa-edit mr-1"></i>Edit
                            </button>

                          
                            <div class="modal fade" id="editModal{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                <form method="post" action="{{ url('/update-pegawai') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{$p->id}}">

                               
                                <label for="Kategori">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control mt-1">                             
                                @foreach($jabatan as $j)
                                    @if($p->ID_JABATAN==$j->ID_JABATAN)  
                                    <option selected value="{{ $j->ID_JABATAN }}" required>{{ $j->NAMA_JABATAN }}</option>
                                    @else
                                    <option value="{{ $j->ID_JABATAN }}" required>{{ $j->NAMA_JABATAN }}</option>
                                    @endif
                                @endforeach
                                </select>
                            
                            

                                <label for="Nama" style="margin-top:10px;">Nama</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" 
                                    id="nama" placeholder="Nama Lengkap" name="nama" value="{{$p->name}}" required>
                                </div>

                                <label for="Alamat">Alamat</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" 
                                    id="alamat" placeholder="Alamat Lengkap" name="alamat" value="{{$p->alamat_user}}" >
                                </div>

                                <label for="Alamat">Email</label>
                                <div class="form-group">
                                    <input type="email" class="demo-code-preview form-control mt-1" 
                                    id="alamat" placeholder="example@gmail.com" name="email" value="{{$p->email}}" required>
                                </div>

                                <label for="Telp">Telepon</label>
                                <div class="form-group">
                                    <input type="number" class="demo-code-preview form-control mt-1" 
                                    id="telp" placeholder="Telepon" name="telpon" value="{{$p->telp_user}}" >
                                </div>

                                <!-- <label for="Alamat">Password</label>
                                <div class="form-group">
                                    <input type="password" class="demo-code-preview form-control mt-1" 
                                    id="password2" placeholder="Password" name="password" value="{{$p->password}}" required>
                                </div>

                                <label for="Alamat">Ulangi Password</label>
                                <div class="form-group">
                                    <input type="password" class="demo-code-preview form-control mt-1" 
                                    id="repeat_password2" onkeyup="cekPass2()" placeholder="Ulangi Password" name="repeat_password" value="{{$p->password}}" required>
                                    <strong><p id="error2" class="mt-1"></p></strong>
                                </div> -->
                           
                                
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
                            @if($p->ID_JABATAN==1)
                                    <!-- <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" 
                                        data-target="#delete1123" onclick="tampil_cant_delete()">
                                        <i class="fas fa-trash-restore mr-1"></i>Hapus</button>  -->
                            @else
                                      <!-- Button trigger modal -->
                                      <!-- <button type="button" class="btn btn-outline-danger mb-1 ml-2" data-toggle="modal" 
                                        data-target="#delete1123{{$p->id}}">
                                        <i class="fas fa-trash-restore mr-1"></i>Hapus</button>
                           
                           

                                    
                                    <div class="modal fade" id="delete1123{{$p->id}}" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <a href="/delete-pegawai/{{$p->id}}">
                                            <button type="button" class="btn btn-primary">
                                            
                                            <font size="3" color="white">Yes</font></button></a>
                                            
                                        </div>
                                        </div>
                                    </div>
                                    </div>  -->
                            @endif
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

    function cekPass(){
        console.log('cekPass1');
                var pass = document.getElementById('password').value;   
                var copass = document.getElementById('repeat_password').value;
                var text = document.getElementById('error');
                if(pass != copass) {
                    text.style.color = '#e3bcba';  
                    text.innerHTML= '*Password tidak sesuai ! ';         
                    }      
                        else        
                        {            
                            text.style.color = '#72b386';    
                            text.innerHTML='*Password Sesuai !';  
                        } 
    }

    function cekPass2(){
        console.log('cekPass2');
                var pass = document.getElementById('password2').value;   
                var copass = document.getElementById('repeat_password2').value;
                var text = document.getElementById('error2');
                if(pass != copass) {
                    text.style.color = '#e3bcba';  
                    text.innerHTML= '*Password tidak sesuai ! ';         
                    }      
                        else        
                        {            
                            text.style.color = '#72b386';    
                            text.innerHTML='*Password Sesuai !';  
                        } 
    }

    function tampil_cant_delete(){
        swal("Oops!","Akun tidak bisa dihapus !","info");
    }
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
swal("Success!","Data Pegawai Berhasil Di Tambahkan","success");
</script>
@endif

@if (session('update_status'))
<script>
swal("Success!","Status Pegawai Berhasil Di Update","success");
</script>
@endif


@if (session('update'))
<script>
swal("Success!","Data Pegawai Berhasil Di Update","success");
</script>
@endif

@if (session('delete'))
<script>
swal("Success!","Data Pegawai Berhasil Di Hapus","success");
</script>
@endif

@if (session('password_tdk_cocok'))
<script>
swal("Oops!","Password tidak cocok !","error");
</script>
@endif

@if (session('email_sama'))
<script>
swal("Oops!","Email sudah digunakan !","error");
</script>
@endif
@endsection