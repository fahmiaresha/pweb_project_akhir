
@extends('layouts.template')

@section('title','Nota Service')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">
@endsection


@foreach($service as $s)
    @if($id_nota==$s->ID_SERVICE)
    @foreach($pelanggan as $p)
    @if($s->ID_PELANGGAN==$p->ID_PELANGGAN)
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-50">
                    <div class="invoice">
                        <div class="d-md-flex justify-content-between align-items-center">
                            <h2 class="font-weight-bold d-flex align-items-center">
                            <img class="logo" src="{{ url('assets/media/image/logo.png') }}" alt="logo">
                            </h2>
                            <h4 class="text-xs-left m-b-0">Service #SRV-{{$id_nota}}</h3>
                        </div>
                        <hr class="m-t-b-50">
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <b>Toko Bagus</b>
                                </p>
                                <p>97,<br>Wonocolo,<br>Sepanjang Sidoarjo 61257</p>
                            </div>
                            
                            <div class="col-md-6">
                                <p class="text-right">
                                    <b>Invoice to</b>
                                </p>
                                                           
                                <p class="text-right">{{$p->NAMA_PELANGGAN}},<br>{{$p->ALAMAT_PELANGGAN}},<br>{{$p->TELP_PELANGGAN}}.
                                </p>
                                    @endif
                                    @endforeach
                                    @endif
                                
                            </div>
                        </div>
                        
                        @if($id_nota==$s->ID_SERVICE)
                        <div class="table-responsive"> 
                            <table class="table mb-4 mt-4">
                                <thead class="thead-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Sepeda</th>
                                    <th>Deskripsi</th>
                                </tr>
                                </thead>
                                <tbody>
                               
                                <tr class="text-right">
                                    <td class="text-left"><font size="2">{{$s->TANGGAL_SERVICE}}</font></td>
                                    <td class="text-left"><font size="2">{{$s->NAMA_SEPEDA_SERVICE}}</font></td>
                                    <td class="text-left"><font size="2">{{$s->DESKRIPSI_SERVICE}}</font></td>
                                </tr>
                                </tbody>
                               
                               
                            </table>
                            
                        </div>
                      
                        <p class="text-center small text-muted  m-t-50">
                        <span class="row">
                        <br>
                        <br>
                            <span class="col-md-6 offset-3">
                                © {{ date('Y') }} - Toko Bagus . All rights reserved
                            </span>
                        </span>
                        </p>
                    </div>
                    <div class="text-right d-print-none">
                        <hr class="my-5">
                        <a href="javascript:window.print()" class="btn btn-success ml-2" style="margin-top:-20px;"> <i class="fa fa-print mr-1"></i>Print Nota</a>
                         <!-- <a href="#" class="btn btn-primary">Send Invoice</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach
@endsection

@section('script')

<script>
$(document).ready(function (){
    $('#myTable').DataTable();
    $('.select2-example').select2();
});
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@endsection