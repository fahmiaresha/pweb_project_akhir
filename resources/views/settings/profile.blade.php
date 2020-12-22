@extends('layouts.template')
@section('title','Profile')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

@endsection

@section('content')

<!-- <div class="page-header d-md-flex justify-content-between">
        <div>
            <h3>Profile</h3>
            <nav aria-label="breadcrumb" class="d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Settings</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div> -->

<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                @php $z=Session::get('id_user') @endphp
                @foreach($pegawai as $p)
                @if($p->id == $z)
                    <div class="card-header">
                    <center><i class="far fa-id-badge fa-2x"></i></center>
                    <center><strong><font size="5" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Profile Users</font></strong></center>   
                    </div>
                    <div class="card-body">
                    <form method="POST" action="/updateprofile">
                            @csrf
                            <input type="hidden" name="id" value="">
                          <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-left">Nama</label>

                        <div class="col-md-6 input-group">
                            <input type="text" name="nama_admin" id="nama_admin" class="form-control @error('nama_admin') is-invalid @enderror" value="{{$p->name}}" readonly>
                            @error('nama_admin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong><font size="2">{{ $message }} </font></strong>
                                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-left">Alamat</label>

                        <div class="col-md-6 input-group">
                        <textarea type="text" class="form-control @error('alamat_admin') is-invalid @enderror" 
                             rows="3" name="alamat_admin" id="alamat_admin" readonly>{{$p->alamat_user}}</textarea>
                             @error('alamat_admin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong><font size="2">{{ $message }} </font></strong>
                                        </span>
                            @enderror
                            </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-left">Telepon</label>

                        <div class="col-md-6 input-group">
                            <input  type="number" name="telp_admin" id="telp_admin" class="form-control @error('telp_admin') is-invalid @enderror" value="{{$p->telp_user}}" readonly>
                            @error('telp_admin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong><font size="2">{{ $message }} </font></strong>
                                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-left">Email</label>

                        <div class="col-md-6 input-group">
                            <input  type="email" name ="email_admin" id="email_admin" class="form-control @error('email_admin') is-invalid @enderror" value="{{$p->email}}" readonly> 
                            @error('email_admin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong><font size="2">{{ $message }} </font></strong>
                                        </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-left">Jabatan</label>

                        <div class="col-md-6 input-group">
                            @foreach($jabatan as $j)
                                @if($j->ID_JABATAN==$p->ID_JABATAN)
                                <input type="text" class="form-control" value="{{$j->NAMA_JABATAN}}" readonly>
                                @endif
                            @endforeach
                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-left"></label>
                        <label class="col-md-3 col-form-label text-md-left"></label>

                        <div class="col-md-4 input-group text-md-right ml-4">
                            <a href="/ubahpassword" target="_blank">Ubah Pasword</a>
                        </div>
                    </div>

                   
                   
                    
                    
                         

                    @endif
                    @endforeach

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="tombol" class="btn btn-primary" onclick="edit()">
                                        Edit Profile
                                    </button>
                                </div>
                            </div>

                          
                            </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

<script>

$("#tombol").click(function(event) { 
                event.preventDefault(); 
    }); 
    


    function edit(){
        document.getElementById("nama_admin").readOnly=false;
        document.getElementById("alamat_admin").readOnly=false;
        document.getElementById("telp_admin").readOnly=false;
        document.getElementById("email_admin").readOnly=false;
         ganti_tombol();

    }

    function ganti_tombol(){
        document.getElementById("tombol").innerHTML='Update Profile';
        $("#tombol").removeClass("btn btn-primary");
        $("#tombol").addClass("btn btn-success update");
        $("#tombol").attr('id','tombol_update');
        $("#tombol_update").attr("onclick","update()");
    }

        function update(){
            $("form").submit();            
    }

</script>

@endsection
