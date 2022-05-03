@extends('layouts.template')
@section('title','Data Tipe Customer')
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
        <h3>Tipe Customer</h3>
        <nav aria-label="breadcrumb" class="d-flex align-items-start">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Customer</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tipe Customer</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <!-- modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#coba">
                <i class="fa fa-plus-circle mr-2"></i> Data Tipe Customer</button>
            <div class="modal fade" tabindex="-1" role="dialog" id="coba">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Tipe Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/store-tipe-customer') }}">
                                @csrf
                                <label for="Alamat">Tipe Customer</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1" id="alamat"
                                        placeholder="Nama Tipe Customer" name="nama_tipe_customer"
                                        value="{{ old('nama_tipe_customer') }}" required>
                                </div>

                                <label for="Alamat">Harga</label>
                                <div class="form-group">
                                    <input type="text" class="demo-code-preview form-control mt-1"
                                        id="harga_tipe_customer" placeholder="Rp. 0" name="harga_tipe_customer"
                                        value="{{ old('harga_tipe_customer') }}" required>
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
                        <th>Nama Tipe User</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipe_customer as $tc)
                    <tr>
                        <td>TC00{{$tc->id_tipe_user}}</td>
                        <td>{{$tc->nama_tipe_user}}</td>
                        <td>Rp. {{number_format($tc->harga_tipe_user)}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info mb-1" data-toggle="modal"
                                data-target="#editModal{{$tc->id_tipe_user}}">
                                <i class="far fa-edit mr-1"></i>Edit
                            </button>

                            <button type="button" class="btn btn-danger mb-1 ml-2" data-toggle="modal"
                                data-target="#delete{{$tc->id_tipe_user}}">
                                <i class="fas fa-trash-restore mr-1"></i>Hapus</button>

                            <div class="modal fade" id="delete{{ $tc->id_tipe_user }}" tabindex="0" role="dialog"
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
                                            <a href="/delete-tipe-customer/{{ $tc->id_tipe_user }}">
                                                <button type="button" class="btn btn-primary">

                                                    <font size="3" color="white">Yes</font>
                                                </button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="editModal{{$tc->id_tipe_user}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Tipe Customer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="{{ url('/update-tipe-customer') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$tc->id_tipe_user}}">

                                                <label for="Alamat">Tipe Customer</label>
                                                <div class="form-group">
                                                    <input type="text" class="demo-code-preview form-control mt-1"
                                                        id="alamat" placeholder="Nama Tipe Customer"
                                                        name="nama_tipe_customer" value="{{ $tc->nama_tipe_user }}"
                                                        required>
                                                </div>

                                                <label for="Alamat">Harga</label>
                                                <div class="form-group">
                                                    <input type="text"
                                                        class="demo-code-preview form-control mt-1 harga_update"
                                                        placeholder="Rp. 0" name="harga_tipe_customer_update"
                                                        value="{{ $tc->harga_tipe_user }}" required>
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


    var harga_tipe_customer = document.getElementById('harga_tipe_customer');
    harga_tipe_customer.addEventListener('keyup', function (e) {
        harga_tipe_customer.value = formatRupiah(this.value, 'Rp. ');
    });

    var harga_tipe_customer_update = document.getElementsByClassName('harga_update');
    console.log(harga_tipe_customer_update.length);
    for (let i = 0; i < harga_tipe_customer_update.length; i++) {
        harga_tipe_customer_update[i].addEventListener('keyup', function (e) {
            harga_tipe_customer_update[i].value = formatRupiah(this.value, 'Rp. ');
        });
    }


    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@if (session('insert'))
<script>
    swal("Success!", "Data Tipe Customer Berhasil Di Tambahkan", "success");

</script>
@endif


@if (session('update'))
<script>
    swal("Success!", "Data Tipe Customer Berhasil Di Update", "success");

</script>
@endif

@if (session('delete'))
<script>
    swal("Success!", "Data Tipe Customer Berhasil Di Hapus", "success");

</script>
@endif

@endsection
