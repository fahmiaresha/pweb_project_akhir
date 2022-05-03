@extends('layouts.template')
@section('title','Data Customer')
@section('head')
<!-- Datatable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

<link rel="stylesheet" href="vendors/lightbox/magnific-popup.css" type="text/css">

@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
    <div>
        <h3>Customer</h3>
        <nav aria-label="breadcrumb" class="d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Customer</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Data Customer</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#coba">
                <i class="fa fa-plus-circle mr-2"></i> Data Customer</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/store-customer') }}" enctype="multipart/form-data">
                                @csrf

                                <label for="Nama">No KTP</label>
                                <div class="form-group">
                                    <input type="number" class="demo-code-preview form-control mt-1" id="nama"
                                        placeholder="Nomor KTP" name="nomor_ktp" value="{{ old('nomor_ktp') }}"
                                        required>
                                </div>

                                <label for="Alamat">Nama</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" id="alamat"
                                        placeholder="Nama Lengkap" name="nama_lengkap"
                                        value="{{ old('nama_lengkap') }}">
                                </div>

                                <label for="Nama" style="margin-top:10px;">Umur</label>
                                <div class="form-group">
                                    <input type="number" class="demo-code-preview form-control mt-1" id="nama"
                                        placeholder="Umur" name="umur" value="{{ old('umur') }}" required>
                                </div>

                                <label for="Alamat">Jenis Kelamin</label>
                                <div class="form-group">
                                    <div class="form-row ml-1">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio1" name="insert_jk"
                                                value="0" checked>
                                            <label class="form-check-label" for="radio1">Laki-Laki</label>
                                        </div>
                                        <div class="form-check ml-4">
                                            <input type="radio" class="form-check-input" id="radio2" name="insert_jk"
                                                value="1">
                                            <label class="form-check-label" for="radio2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>

                                <label for="Telp">Telepon</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" id="telp"
                                        placeholder="Telepon" name="telpon" value="{{ old('telp') }}">
                                </div>

                                <label for="Nama" style="margin-top:10px;">Foto KTP</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file" required>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @if(count($errors) > 0)
                                    <div class="alert alert-danger mt-2">
                                        @foreach ($errors->all() as $error)
                                        {{ $error }}
                                        @endforeach
                                    </div>
                                    @endif
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
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nomor KTP</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Nomor Telp</th>
                        <th>Foto KTP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer as $c)
                    <tr>
                        <td>CUS00{{$c->id}}</td>
                        <td>{{$c->no_ktp}}</td>
                        <td>{{$c->name}}</td>
                        <td>{{$c->umur}} Tahun</td>
                        <td>
                            @if($c->jenis_kelamin==0)
                            Laki - Laki
                            @else
                            Perempuan
                            @endif

                        </td>
                        <td>{{$c->telp}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal"
                                data-target="#lihatfoto{{ $c->id }}">
                                <i class="fa fa-image mr-1"></i>Lihat
                            </button>

                            <div class="modal fade" id="lihatfoto{{ $c->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Foto KTP {{$c->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="coba">
                                                <center class="image-popup"
                                                    href="{{ url('/foto_ktp/'.$c->upload_ktp) }}">
                                                    <img data-dismiss="modal"
                                                        style="height:auto; max-width:100%; cursor:zoom-in;"
                                                        src="{{ url('/foto_ktp/'.$c->upload_ktp) }}">
                                                </center>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
        </td>
        <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-info mb-1" data-toggle="modal" data-target="#editModal{{$c->id}}">
                <i class="far fa-edit mr-1"></i>Edit
            </button>

            <button type="button" class="btn btn-danger mb-1 ml-2" data-toggle="modal" data-target="#delete{{$c->id}}">
                <i class="fas fa-trash-restore mr-1"></i>Hapus</button>

            <div class="modal fade" id="delete{{ $c->id }}" tabindex="0" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <a href="/delete-customer/{{ $c->id }}">
                                <button type="button" class="btn btn-primary">

                                    <font size="3" color="white">Yes</font>
                                </button></a>

                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="editModal{{$c->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="post" action="{{ url('/update-customer') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$c->id}}">

                                <label for="Nama">No KTP</label>
                                <div class="form-group">
                                    <input type="number" class="demo-code-preview form-control mt-1" id="nama"
                                        placeholder="Nomor KTP" name="nomor_ktp" value="{{ $c->no_ktp }}" required>
                                </div>

                                <label for="Alamat">Nama</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" id="alamat"
                                        placeholder="Nama Lengkap" name="nama_lengkap" value="{{ $c->name }}">
                                </div>

                                <label for="Nama" style="margin-top:10px;">Umur</label>
                                <div class="form-group">
                                    <input type="number" class="demo-code-preview form-control mt-1" id="nama"
                                        placeholder="Umur" name="umur" value="{{ $c->umur }}" required>
                                </div>

                                <label for="Alamat">Jenis Kelamin</label>
                                @if($c->jenis_kelamin==0)
                                <div class="form-group">
                                    <div class="form-row ml-1">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio1" name="update_jk"
                                                value="0" checked>
                                            <label class="form-check-label" for="radio1">Laki-Laki</label>
                                        </div>
                                        <div class="form-check ml-4">
                                            <input type="radio" class="form-check-input" id="radio2" name="update_jk"
                                                value="1">
                                            <label class="form-check-label" for="radio2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="form-group">
                                    <div class="form-row ml-1">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio1" name="update_jk"
                                                value="0">
                                            <label class="form-check-label" for="radio1">Laki-Laki</label>
                                        </div>
                                        <div class="form-check ml-4">
                                            <input type="radio" class="form-check-input" id="radio2" name="update_jk"
                                                value="1" checked>
                                            <label class="form-check-label" for="radio2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                

                                <label for="Telp">Telepon</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" id="telp"
                                        placeholder="Telepon" name="telpon" value="{{ $c->telp }}">
                                </div>

                                <label for="Nama" style="margin-top:10px;">Foto KTP</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file">
                                        <label class="custom-file-label" for="customFile">Choose
                                            file</label>
                                    </div>
                                    @if(count($errors) > 0)
                                    <div class="alert alert-danger mt-2">
                                        @foreach ($errors->all() as $error)
                                        {{ $error }}
                                        @endforeach
                                    </div>
                                    @endif
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

<script src="vendors/lightbox/jquery.magnific-popup.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
        $('.select2-example').select2();

        const x = document.getElementsByClassName('post0');
        for (let i = 0; i < x.length; i++) {
            x[i].addEventListener('click', function () {
                x[i].submit();
            });
        }

        $('.image-popup').magnificPopup({
            type: 'image',
            zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out',
                opener: function (openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
        });

    });

</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
    swal("Success!", "Data Customer Berhasil Di Tambahkan", "success");

</script>
@endif


@if (session('update'))
<script>
    swal("Success!", "Data Customer Berhasil Di Update", "success");

</script>
@endif

@if (session('delete'))
<script>
    swal("Success!", "Data Customer Berhasil Di Hapus", "success");

</script>
@endif

@endsection
