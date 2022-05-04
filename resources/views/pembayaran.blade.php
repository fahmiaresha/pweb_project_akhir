@extends('layouts.template')
@section('title','Data Pembayaran')
@section('head')
<!-- Datatable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">

<link rel="stylesheet" href="vendors/lightbox/magnific-popup.css" type="text/css">

<!-- Css -->
<link rel="stylesheet" href="vendors/clockpicker/bootstrap-clockpicker.min.css" type="text/css">

@endsection

@section('content')
<div class="page-header d-md-flex justify-content-between">
    <div>
        <h3>Waktu</h3>
        <nav aria-label="breadcrumb" class="d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <!-- <li class="breadcrumb-item">
                    <a href="#">Customer</a>
                </li> -->
                <li class="breadcrumb-item active" aria-current="page">Data Pembayaran</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#coba">
                <i class="fa fa-plus-circle mr-2"></i> Data Pembayaran</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/store-pembayaran') }}" enctype="multipart/form-data">
                                @csrf
                                <label for="Kategori">Pemesanan</label>
                                <select name="id_pemesanan" required class="select2-example">
                                    <option disabled="true" selected="true" value="">Pilih Pemesanan</option>
                                    @foreach($pemesanan as $p)
                                    <option value="{{ $p->id_pemesanan }}" required>
                                        PM00{{ $p->id_pemesanan }} - {{ $p->name }}</option>
                                    @endforeach
                                </select>
                                <div class="div mt-2">
                                </div>

                                <label for="Kategori">Pembayaran</label>
                                <select name="tipe_pembayaran" required class="select2-example">
                                    <option disabled="true" selected="true" value="">Pilih Tipe Pembayaran</option>
                                    <option value="0">Tunai</option>
                                    <option value="1">Non - Tunai</option>
                                </select>
                                <div class="div mt-2">
                                </div>

                                <label for="Nama" style="margin-top:10px;">Bukti Transfer</label>
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

                                <div class="modal-footer ">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Insert</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tutup modal -->
        <table id="myTable" class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Pemesanan</th>
                    <th>Tipe Pembayaran</th>
                    <th>Bukti Transfer</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayaran as $p)
                <tr>
                    <td>PB00{{$p->id_pembayaran}}</td>
                    <td>
                        @foreach($pemesanan as $pm)
                        @if($p->id_pemesanan == $pm->id_pemesanan)
                        PM00{{$pm->id_pemesanan}} - {{$pm->name}}
                        @endif
                        @endforeach
                    </td>
                    <td>
                        @if($p->tipe_pembayaran == 0)
                        Tunai
                        @else
                        Non - Tunai
                        @endif
                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-info mb-1" data-toggle="modal"
                            data-target="#lihatfoto{{ $p->id_pembayaran }}">
                            <i class="fa fa-image mr-1"></i>Lihat
                        </button>

                        <div class="modal fade" id="lihatfoto{{ $p->id_pembayaran }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Foto Pembayaran
                                            PM00{{$p->id_pembayaran}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="coba">
                                            <center class="image-popup"
                                                href="{{ url('/foto_pembayaran/'.$p->upload_bukti_transfer) }}">
                                                <img data-dismiss="modal"
                                                    style="height:auto; max-width:100%; cursor:zoom-in;"
                                                    src="{{ url('/foto_pembayaran/'.$p->upload_bukti_transfer) }}">
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-info mb-1" data-toggle="modal"
                            data-target="#editModal{{$p->id_pembayaran}}">
                            <i class="far fa-edit mr-1"></i>Edit
                        </button>

                        <button type="button" class="btn btn-danger mb-1 ml-2" data-toggle="modal"
                            data-target="#delete{{$p->id_pembayaran}}">
                            <i class="fas fa-trash-restore mr-1"></i>Hapus</button>

                        <div class="modal fade" id="delete{{ $p->id_pembayaran }}" tabindex="0" role="dialog"
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
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Back</button>
                                        <a href="/delete-pembayaran/{{ $p->id_pembayaran }}">
                                            <button type="button" class="btn btn-primary">

                                                <font size="3" color="white">Yes</font>
                                            </button></a>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="editModal{{$p->id_pembayaran}}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pembayaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="post" action="{{ url('/update-pembayaran') }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$p->id_pembayaran}}">
                                            <label for="Kategori">Pemesanan</label>
                                            <div>
                                                <select name="id_pemesanan" required class="select2-example">
                                                    <option disabled="true" selected="true" value="">Pilih Pemesanan
                                                    </option>
                                                    @foreach($pemesanan as $pm)
                                                    @if($p->id_pemesanan == $pm->id_pemesanan)
                                                    <option selected value="{{ $pm->id_pemesanan }}" required>
                                                        PM00{{ $pm->id_pemesanan }} - {{ $pm->name }}</option>
                                                    @else
                                                    <option value="{{ $pm->id_pemesanan }}" required>
                                                        PM00{{ $pm->id_pemesanan }} - {{ $pm->name }}</option>
                                                    @endif

                                                    @endforeach
                                                </select>
                                                <div class="div mt-2">
                                                </div>
                                            </div>

                                            <label for="Kategori">Pembayaran</label>
                                            <div>
                                                <select name="tipe_pembayaran" required class="select2-example">
                                                    <option disabled="true" selected="true" value="">Pilih Tipe
                                                        Pembayaran</option>
                                                    @if($p->tipe_pembayaran == 0)
                                                    <option selected value="0">Tunai</option>
                                                    <option value="1">Non - Tunai</option>
                                                    @else
                                                    <option  value="0">Tunai</option>
                                                    <option selected value="1">Non - Tunai</option>
                                                    @endif
                                                  
                                                </select>
                                                <div class="div mt-2">
                                                </div>
                                            </div>

                                            <label for="Nama" style="margin-top:10px;">Bukti Transfer</label>
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
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Back</button>
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

<script src="vendors/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="vendors/lightbox/jquery.magnific-popup.min.js"></script>
<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>


<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
        $('.select2-example').select2();
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

    $('.clockpicker-example').clockpicker({
        autoclose: true
    });

</script>

@if (session('insert'))
<script>
    swal("Success!", "Data Pembayaran Berhasil Di Tambahkan", "success");

</script>
@endif


@if (session('update'))
<script>
    swal("Success!", "Data Pembayaran Berhasil Di Update", "success");

</script>
@endif

@if (session('delete'))
<script>
    swal("Success!", "Data Pembayaran Berhasil Di Hapus", "success");

</script>
@endif

@endsection
