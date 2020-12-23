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
                <div class="modal fade" tabindex="-1" role="dialog" id="modal_ubah_password">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ url('/ubah-password-pegawai') }}">       
                @csrf
                    <input type="hidden" name="id" value="{{$z}}"> <br/>
                            
                    <div class="form-group row" style="margin-top:-40px;" >
                        <label for="current_password" class="col-md-4 col-form-label text-md-left">Current Password</label>

                        <div class="col-md-6 input-group" id="show_hide_password2">
                            <input id="current_password" type="password" placeholder="Current Password" class="form-control @error('current_password') is-invalid @enderror" name="current_password">
                            <div class="input-group-append" style="padding-bottom: 15px;">
                                <span class="input-group-text"><a href=""><i class="fa fa-eye" aria-hidden="true" style="color:white"></i> </a></span>
                                </div>
                            
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong><font size="2">{{ $message }}</font></strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-left">New Password</label>
                                <div class="col-md-6 input-group" id="show_hide_password">
                                <input id="password" type="password" placeholder="New Password" class="form-control @error('password') is-invalid @enderror" name="password" >
                                <div class="input-group-append" style="padding-bottom: 15px;">
                                <span class="input-group-text"><a href=""><i class="fa fa-eye" aria-hidden="true" style="color:white"></i> </a></span>
                                </div>
                               

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong><font size="2">{{ $message }} </font></strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-left">Confirm Password</label>

                                <div class="col-md-6 input-group"  id="show_hide_password3">
                                    <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                    <div class="input-group-append" style="padding-bottom: 15px;">
                                    <span class="input-group-text"><a href=""><i class="fa fa-eye" aria-hidden="true" style="color:white"></i> </a></span>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong><font size="2">{{ $message }} </font></strong>
                                        </span>
                                    @enderror
                                </div>

                                
                                
                            </div>

                   

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>

                        </form>

          
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Insert</button>
                    </form>
                </div> -->
                </div>
            </div>
            </div>
             <!-- tutup modal -->

                @foreach($pegawai as $p)
                @if($p->id == $z)
                    <div class="card-header">
                    <center><i class="far fa-id-badge fa-2x"></i></center>
                    <center><strong><font size="5" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Profile Users</font></strong></center>   
                    </div>
                    <div class="card-body">
                    <form method="POST" action="/update-profile">
                            @csrf
                            <input type="hidden" name="id" value="{{$z}}">
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
                            <a style="cursor:pointer;" data-toggle="modal"  data-target="#modal_ubah_password">Ubah Password</a>
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

<script>
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });

    $("#show_hide_password2 a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password2 input').attr("type") == "text"){
            $('#show_hide_password2 input').attr('type', 'password');
            $('#show_hide_password2 i').addClass( "fa-eye-slash" );
            $('#show_hide_password2 i').removeClass( "fa-eye" );
        }else if($('#show_hide_password2 input').attr("type") == "password"){
            $('#show_hide_password2 input').attr('type', 'text');
            $('#show_hide_password2 i').removeClass( "fa-eye-slash" );
            $('#show_hide_password2 i').addClass( "fa-eye" );
        }
    });

    $("#show_hide_password3 a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password3 input').attr("type") == "text"){
            $('#show_hide_password3 input').attr('type', 'password');
            $('#show_hide_password3 i').addClass( "fa-eye-slash" );
            $('#show_hide_password3 i').removeClass( "fa-eye" );
        }else if($('#show_hide_password3 input').attr("type") == "password"){
            $('#show_hide_password3 input').attr('type', 'text');
            $('#show_hide_password3 i').removeClass( "fa-eye-slash" );
            $('#show_hide_password3 i').addClass( "fa-eye" );
        }
    });

});
</script>

@if (session('update_profile'))
<script>
swal("Success!","Profile Berhasil Di Update","success");
</script>
@endif

@if (session('password_sukses_diubah'))
<script>
swal("Success!","Password Berhasil Di Ubah","success");
</script>
@endif

@if (session('password_baru_lama_sama'))
<script>
swal("Oops!","Password tidak boleh sama","info");
</script>
@endif

@if (session('password_konfirmasipassword_tdk_cocok'))
<script>
swal("Oops!","Konfirmasi password tidak cocok","error");
</script>
@endif


@if (session('current_password_tidak_cocok'))
<script>
swal("Oops!","Password salah","error");
</script>
@endif


@endsection
