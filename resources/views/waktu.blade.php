@extends('layouts.template')
@section('title','Data Waktu')
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
                <li class="breadcrumb-item active" aria-current="page">Data Waktu</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#coba">
                <i class="fa fa-plus-circle mr-2"></i> Data Waktu</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Waktu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/store-waktu') }}">
                                @csrf
                                <label for="Alamat">Waktu</label>
                                <div class="input-group clockpicker-example">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-clock-o"></i>
                                        </span>
                                    </div>
                                    <input name="waktu" type="text" class="form-control" value="00:00">
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
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($waktu as $w)
                    <tr>
                        <td>W00{{$w->id_waktu}}</td>
                        <td>{{$w->jam}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info mb-1" data-toggle="modal"
                                data-target="#editModal{{$w->id_waktu}}">
                                <i class="far fa-edit mr-1"></i>Edit
                            </button>

                            <button type="button" class="btn btn-danger mb-1 ml-2" data-toggle="modal"
                                data-target="#delete{{$w->id_waktu}}">
                                <i class="fas fa-trash-restore mr-1"></i>Hapus</button>

                            <div class="modal fade" id="delete{{ $w->id_waktu }}" tabindex="0" role="dialog"
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
                                            <a href="/delete-waktu/{{ $w->id_waktu }}">
                                                <button type="button" class="btn btn-primary">

                                                    <font size="3" color="white">Yes</font>
                                                </button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="editModal{{$w->id_waktu}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Waktu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="{{ url('/update-waktu') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$w->id_waktu}}">

                                                <label for="Alamat"> Waktu</label>
                                                <div class="input-group clockpicker-example">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-clock-o"></i>
                                                        </span>
                                                    </div>
                                                    <input name="waktu" type="text" class="form-control" value="{{ $w->jam }}">
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
    });

    $('.clockpicker-example').clockpicker({
        autoclose: true
        });

</script>

@if (session('insert'))
<script>
    swal("Success!", "Data Waktu Berhasil Di Tambahkan", "success");

</script>
@endif


@if (session('update'))
<script>
    swal("Success!", "Data Waktu Berhasil Di Update", "success");

</script>
@endif

@if (session('delete'))
<script>
    swal("Success!", "Data Waktu Berhasil Di Hapus", "success");

</script>
@endif

@endsection
