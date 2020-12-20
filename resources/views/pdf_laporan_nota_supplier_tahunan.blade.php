<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Nota Supplier {{date('d-m-Y', strtotime($fromdate)) }} - {{date('d-m-Y', strtotime($todate)) }}</title>
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
    <div class="coba" style="margin-bottom:5px;"><font size="5"><strong>Laporan Nota Supplier</strong></font></div>
    </strong>
    </center>
    <strong><p>Tanggal Laporan :   {{date('d-m-Y', strtotime($fromdate)) }} s/d
               {{date('d-m-Y', strtotime($todate)) }}</p> </strong> 

               <p style="margin-top:-10px;"> <strong> Sort by :    
                @if($input_supplier=='kosong')
                    All
                @else
                    @foreach($supplier as $s)
                            @if($s->ID_SUPPLIER==$input_supplier)
                                {{$s->NAMA_SUPPLIER}} - {{$s->ALAMAT_SUPPLIER}}
                            @endif
                    @endforeach
                @endif
                </strong> 
                 </p>             
    <table style="width:100%;" id="customers">
                        <thead>
                        
                            <tr>
                            <th>#</th>
                            <th><center>Supplier</center></th>
                            <th><center>Status</center></th>
                            <th><center>Nomor Nota</center></th>
                            <th><center>Tanggal Nota</center></th>
                            <th><center>Total Bayar</center></th>
                            </tr>
                        </thead>                       
                            @php 
                            $status_sudah_dibayar=0;
                            $status_belum_dibayar=0;
                            $nomor=1;
                            @endphp        
                        @foreach($result as $y)
                            <tr>
                                <td>@php echo $nomor++; @endphp</td>
                                @foreach($supplier as $s)
                                    @if($s->ID_SUPPLIER==$y->ID_SUPPLIER)
                                    <td> {{$s->NAMA_SUPPLIER}} - {{$s->ALAMAT_SUPPLIER}}                </td>
                                    @endif
                                @endforeach
                               
                                <td>
                                @if($y->STATUS_NOTA_SUPPLIER==1)
                                Lunas
                                @else
                                Belum Lunas
                                @endif
                                </td>
                                <td> {{$y->NOMOR_NOTA_SUPPLIER}}  </td>
                                <td>  {{date('d-m-Y', strtotime($y->TANGGAL_NOTA_DATANG)) }}  </td>
                            
                                <td> Rp. {{ number_format($y->TOTAL_BAYAR_NOTA_SUPPLIER)}}    </td>
                                </tr>
                            @if($y->STATUS_NOTA_SUPPLIER==1)
                                @php $status_sudah_dibayar += $y->TOTAL_BAYAR_NOTA_SUPPLIER @endphp
                            @else
                                @php $status_belum_dibayar += $y->TOTAL_BAYAR_NOTA_SUPPLIER @endphp
                            @endif
                        @endforeach
                        <tfoot>
                        <tr style="background-color:#009DC4; color:white">
                        <td  colspan="2" style="text-align:left;"><strong>TOTAL NOTA</strong></td>
                        <td  colspan="1" style="text-align:left; "><strong>Belum Lunas</strong></td>
                            <td  colspan="1"  style="text-align:left;"><strong>Rp. {{ number_format($status_belum_dibayar)}} </strong></td>

                            <td colspan="1"style="text-align:left;"><strong>Lunas</strong></td>
                            <td  colspan="2" style="text-align:left;"><strong>Rp. {{ number_format($status_sudah_dibayar)}}</strong> </td>         
                        </tr>

                        

               </tfoot> 
                </table>
    <br>

           
               <center>
               <div class="yay">© {{ date('Y') }} - Toko Bagus . All rights reserved</div>
               </center>

               
              
              
</body>
</html>