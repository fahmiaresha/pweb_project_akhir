<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Barang {{date('d-m-Y', strtotime($fromdate)) }} - {{date('d-m-Y', strtotime($todate)) }}</title>
</head>
<style>
 @page {
    size: 21cm 29.7cm;
 }
 body {font-size: 11pt;
    }
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #403b3b;
  color: white;
}
    </style>
<body>
@php
    date_default_timezone_set('Asia/Jakarta');
@endphp
<strong><p style="text-align:right;">Dibuat : {{date('d-m-Y H:i:s')}}</p> </strong>
    

    <center>
    <strong>
    <div class="coba" style="margin-bottom:5px;"><font size="5"><strong>Toko Bagus</strong></font>
    
    </div>
    <div class="coba" style="margin-bottom:5px;"><font size="5"><strong>Laporan Penjualan Barang</strong></font></div>
    </strong>
    </center>
    <strong><p>Tanggal Laporan :   {{date('d-m-Y', strtotime($fromdate)) }} s/d
               {{date('d-m-Y', strtotime($todate)) }}</p> </strong> 
    
               <p style="margin-top:-10px;"> <strong> Sort by :    
                @if($input_produk=='kosong')
                    All
                @else
                    @foreach($product as $p)
                        @foreach($kategori_produk as $kp)
                            @if($input_produk==$p->ID_PRODUK)
                                @if($p->ID_KATEGORI_PRODUK==$kp->ID_KATEGORI_PRODUK)
                                    {{$kp->NAMA_KATEGORI_PRODUK}} - {{$p->NAMA_PRODUK}} 
                                @endif 
                            @endif
                        @endforeach     
                    @endforeach
                @endif
                </strong> 
                 </p>     
    
    <table style="width:100%;" id="customers">
                        <thead>
                        
                        <tr>
                            <th>#</th>
                            <th><center>Invoice</center></th>
                            <th><center>Tanggal</center></th>
                            <th><center>Kategori</center></th>
                            <th><center>Pelanggan</center></th>
                            <th><center>Kasir</center></th>
                            <th><center>Total Bayar</center></th>
                            </tr>
                        </thead>                       
                         
                           
                           @php 
                            $total_penjualan_umum=0;
                            $total_penjualan_reseller=0;
                            $total_penjualan_fix=0;
                            $nomor=1;
                            @endphp
                           @foreach($result as $p)
                           <tr>
                           <td>{{$nomor++}}</td>
                           <td>INV-{{$p->ID_PENJUALAN}}</td>
                    <td> {{date('d-m-Y H:i:s', strtotime($p->TANGGAL_PENJUALAN)) }}</td>           
                    <td>
                        @foreach($kategori_pelanggan as $kp)
                        @if($p->KATEGORI_PELANGGAN_PENJUALAN==$kp->ID_KATEGORI_PELANGGAN)
                        {{$kp->NAMA_KATEGORI_PELANGGAN}}
                        @endif
                        @endforeach
                    </td>
                    <td>
                    @if($p->ID_PELANGGAN==null)
                    Umum
                    @else
                        @foreach($pelanggan as $pl)
                             @if($p->ID_PELANGGAN==$pl->ID_PELANGGAN)
                                {{$pl->NAMA_PELANGGAN}} - {{$pl->ALAMAT_PELANGGAN}}
                             @endif
                        @endforeach
                    @endif  
                    </td>
                    <td>Fahmi Aresha</td>
                    @if($input_produk=='kosong')
                    <td>Rp. {{ number_format($p->TOTAL_PENJUALAN)}}</td>
                    @else
                    <td>Rp. {{ number_format($p->TOTAL_HARGA_PRODUK)}}</td>
                    @endif
                    </tr>
                        @if($input_produk=='kosong')
                            @if($p->KATEGORI_PELANGGAN_PENJUALAN==1)
                                @php $total_penjualan_reseller += $p->TOTAL_PENJUALAN; @endphp
                            @endif
                            @if($p->KATEGORI_PELANGGAN_PENJUALAN==2)
                                @php $total_penjualan_umum += $p->TOTAL_PENJUALAN; @endphp
                            @endif
                        @else
                            @if($p->KATEGORI_PELANGGAN_PENJUALAN==1)
                                @php $total_penjualan_reseller += $p->TOTAL_HARGA_PRODUK; @endphp
                            @endif
                            @if($p->KATEGORI_PELANGGAN_PENJUALAN==2)
                                @php $total_penjualan_umum += $p->TOTAL_HARGA_PRODUK; @endphp
                            @endif
                        @endif
                    @endforeach

                    @php $total_penjualan_fix=$total_penjualan_reseller + $total_penjualan_umum; @endphp
                                 
                    <tfoot>
                    <tr>
                    <td  colspan="3" style="text-align:left;  border: none;"><strong><i class="fa fa-info-circle mr-2"></i>Penjualan Reseller</strong></td>
                        <td colspan="1" style="text-align:left;  border: none;">Rp. {{ number_format($total_penjualan_reseller)}} </td>
                        <td  colspan="2" style="text-align:left;  border: none;"><strong><i class="fa fa-info-circle mr-2"></i>Penjualan Non-Reseller</strong></td>
                        <td colspan="1" style="text-align:left;  border: none;">Rp. {{ number_format($total_penjualan_umum)}}</td>
                    </tr>
                   
                    
                        
                    <tr style="background-color:#009DC4; color:white">
                        <td colspan="5" style="text-align:left;  border: none;"><strong><i class="ti-check mr-2"></i>Total Penjualan</strong></td>
                        <td colspan="2" style="text-align:right;  border: none;">Rp. {{ number_format($total_penjualan_fix)}} </td>
                    </tr>
                    </tfoot>
                </table>
    <br>

           
               <center>
               <div class="yay">© {{ date('Y') }} - Toko Bagus . All rights reserved</div>
               </center>

               
              
              
</body>
</html>