<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan #NTA-{{$id_invoice}}</title>
    <style>
  @page {
    size: 5.7cm 5cm;
    margin: 8px 8px 8px 8px;
    }
    body {font-size: 4pt;
    }
    /* table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
} */
}
/* style="float:right" */
    </style>
    

</head>
<body>
<center>
<strong>
    <div class="coba" style="margin-bottom:1px;">Toko Bagus</div>
    <div class="coba" style="margin-bottom:1px;">Wonocolo Sepanjang No.97</div>
    <div class="coba" style="margin-bottom:1px;">Telp. 089-6346-5688</div>
    </strong>
    </center>



    <table>
                                                <tbody>

                                                   
                                                    <tr>
                                                        <td><strong>Nomor  <strong></td>
                                                        <td>: NTA-{{$id_invoice}}</td>
                                                    </tr>
                                                    
                                                    @foreach ($penjualan as $p)
                                                        @if($id_invoice==$p->ID_PENJUALAN)
                                                        <tr>
                                                        <td><strong>Tanggal</strong></td>
                                                        <td>: {{date('d-m-Y H:i:s', strtotime($p->TANGGAL_PENJUALAN)) }}</td>
                                                        </tr>
                                                    <tr>
                                                        <td><strong>Kasir</strong></td>
                                                        <td>:
                                                        @foreach($users as $u)
                                                            @if($p->ID_USER==$u->id)
                                                             {{$u->name}}
                                                            @endif
                                                        @endforeach
                                                        </td>
                                                    </tr>
                                                        <!-- <tr>
                                                        <td><strong>Pelanggan <strong> </td>
                                                        <td>: 
                                                                    
                                                                        @foreach($pelanggan as $pl)
                                                                            @if($p->ID_PELANGGAN==$pl->ID_PELANGGAN)
                                                                                {{$pl->NAMA_PELANGGAN}}
                                                                            @endif
                                                                        @endforeach
                                                        </td>
                                                        </tr>  -->
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                    <td><strong>Kategori  <strong></td>
                                                    @foreach($penjualan as $p)
                                                            @if($id_invoice==$p->ID_PENJUALAN)
                                                                @foreach($kategori_pelanggan as $kp)
                                                                    @if($p->KATEGORI_PELANGGAN_PENJUALAN==$kp->ID_KATEGORI_PELANGGAN)
                                                                    <td>: {{$kp->NAMA_KATEGORI_PELANGGAN}}</div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                    @endforeach
                                                    </tr>

                                                   
                                                    
                                                </tbody>
    </table>

    <div class="coba">==================================================================</div>
    <table style="width:100%;">
                        <thead>
                        <tr>
                          <th>Kategori</th>
                          <th>Produk</th>
                          <th>Harga</th>
                          <th>Qty</th>
                          <th>Total</th>
                        </tr>
                        </thead>
                       
                       
                            @foreach($detail_penjualan as $dp)
                                @if($id_invoice==$dp->ID_PENJUALAN)
                                    @foreach($product as $pr)
                                        @if($dp->ID_PRODUK==$pr->ID_PRODUK)
                                            @foreach($kategori_produk as $kp)
                                                @if($pr->ID_KATEGORI_PRODUK==$kp->ID_KATEGORI_PRODUK)
                            <tr>
                                                <td>{{$kp->NAMA_KATEGORI_PRODUK}}</td>
                                                @endif
                                            @endforeach
                                        <td>{{$pr->NAMA_PRODUK}}</td>
                                        @endif
                                    @endforeach
                            <td>Rp. {{ number_format($dp->HARGA_PRODUK)}}</td>
                            <td><center>{{$dp->JUMLAH_PRODUK}}</center></td>
                            <td>Rp. {{ number_format($dp->TOTAL_HARGA_PRODUK)}}</td> 
                            </tr>
                                @endif
                            @endforeach
                        </table>

                        
                        <div class="coba">==================================================================</div>
                    
                        <table class="table" style="float:right; ">
                                                <tbody>
                                                <tr>
                                                @foreach($penjualan as $p)
                                                @if($id_invoice==$p->ID_PENJUALAN)
                                                    <td><strong>Total Bayar<strong></td>
                                                    <td>Rp. {{ number_format($p->TOTAL_PENJUALAN)}}</td>
                                                    </tr>
                                                    <tr>
                                                    <td><strong>Cash</strong></td>
                                                    <td>Rp. {{ number_format($p->CASH_PELANGGAN)}}</td>
                                                    </tr>
                                                    <tr>
                                                    <td><strong>Change <strong> </td>
                                                    <td>Rp. {{ number_format($p->CHANGE_PELANGGAN)}}</td>
                                                    </tr>
                                                @endif
                                                @endforeach
                                                </tbody>
                        </table>
                        <div class="yay" style="font-size: 3pt;"> © {{ date('Y') }} - Toko Bagus . All rights reserved</div>
<center>
    <div class="terimakasih" style="margin-top:35px;">
    <div class="yay" style="margin-bottom:1px;" ><strong>TERIMA KASIH</strong></div>
    <div class="yay" style="margin-bottom:1px;">*Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.</div>
    
    </div>
</center>
    
</body>
</html>