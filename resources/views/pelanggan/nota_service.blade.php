@extends('layouts.template')
@section('title','Nota Service')
@section('head')
  <!-- Datatable -->
  <link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
 <!-- select2 -->
<link rel="stylesheet" href="../../vendors/select2/css/select2.min.css" type="text/css">
@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-50">
                    <div class="invoice">
                        <div class="d-md-flex justify-content-between align-items-center">
                            <h2 class="font-weight-bold d-flex align-items-center">
                                <img src="{{ url('assets/media/image/dark-logo.png') }}" alt="dark logo">
                            </h2>
                            <h4 class="text-xs-left m-b-0">Service #SRV-0{{$id_nota}}</h3>
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
                                @foreach($service as $s)
                                    @foreach($pelanggan as $p)
                                    @if($s->ID_PELANGGAN==$p->ID_PELANGGAN)    
                                <p class="text-right">{{$p->NAMA_PELANGGAN}},<br>{{$p->ALAMAT_PELANGGAN}},<br>{{$p->TELP_PELANGGAN}}.
                                </p>
                                @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-4 mt-4">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Unit cost</th>
                                    <th class="text-right">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-right">
                                    <td class="text-left">1</td>
                                    <td class="text-left">Brochure Design</td>
                                    <td>2</td>
                                    <td>$20</td>
                                    <td>$40</td>
                                </tr>
                                <tr class="text-right">
                                    <td class="text-left">2</td>
                                    <td class="text-left">Web Design Packages(Template) - Basic</td>
                                    <td>05</td>
                                    <td>$25</td>
                                    <td>$125</td>
                                </tr>
                                <tr class="text-right">
                                    <td class="text-left">3</td>
                                    <td class="text-left">Print Ad - Basic - Color</td>
                                    <td>08</td>
                                    <td>$500</td>
                                    <td>$4000</td>
                                </tr>
                                <tr class="text-right">
                                    <td class="text-left">4</td>
                                    <td class="text-left">Down Coat</td>
                                    <td>1</td>
                                    <td>$5</td>
                                    <td>$5</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <p>Sub - Total amount: $12,348</p>
                            <p>vat (10%) : $138</p>
                            <h4 class="font-weight-800">Total : $13,986</h4>
                        </div>
                        <p class="text-center small text-muted  m-t-50">
                        <span class="row">
                            <span class="col-md-6 offset-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, at.
                            </span>
                        </span>
                        </p>
                    </div>
                    <div class="text-right d-print-none">
                        <hr class="my-5">
                        <a href="#" class="btn btn-primary">Send Invoice</a>
                        <a href="javascript:window.print()" class="btn btn-success ml-2">Print</a>
                    </div>
                </div>
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
</script>

<script src="../../vendors/select2/js/select2.min.js"></script>
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/pages/user-list.js') }}"></script>

@endsection