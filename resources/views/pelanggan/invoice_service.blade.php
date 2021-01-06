<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service #SRV-{{$id_invoice}}</title>
</head>
<style>
    @page {
    size: 5.7cm 5cm;
    margin: 8px 8px 8px 8px;
    }
    body {font-size: 4pt;
    }
</style>
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
    <td><strong>Nomor <strong></td>
    <td>: SRV-{{$id_invoice}}</td>
    </tr>
    @foreach($service as $s)
        @if($s->ID_SERVICE==$id_invoice)
        <tr>
        <td><strong>Tanggal <strong></td>
        <td>:  {{date('d-m-Y H:i:s', strtotime($s->TANGGAL_SERVICE)) }}</td>
        </tr>
        <tr>
        <td><strong>Kasir<strong></td>
        <td>:
        @foreach($users as $u)
                        @if($s->PEGAWAI==$u->id)
                            {{$u->name}}
                        @endif
        @endforeach
        </td>
        </tr>
            @foreach($pelanggan as $p)
                @if($s->ID_PELANGGAN==$p->ID_PELANGGAN)
                <tr>
                <td><strong>Pelanggan <strong></td>
                <td>:  {{$p->NAMA_PELANGGAN}}</td>
                </tr>
                    @foreach($kategori_pelanggan as $kp)
                        @if($p->ID_KATEGORI_PELANGGAN==$kp->ID_KATEGORI_PELANGGAN)             
                            <tr>
                            <td><strong>Kategori <strong></td>
                            <td>: {{$kp->NAMA_KATEGORI_PELANGGAN}}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endif
    @endforeach
    </tbody>     
    </table>

    <div class="coba">==================================================================</div>

    <table style="width:100%;">
                        <thead>
                        <tr>
                          <th>Nama Sepeda</th>
                          <th>Deskripsi Service</th>
                        </tr>
                        </thead>
                        @foreach($service as $s)
                            @if($s->ID_SERVICE==$id_invoice)
                            
                            <tr>
                            <td><center>{{$s->NAMA_SEPEDA_SERVICE}} </center></td>
                            <td><center> {{$s->DESKRIPSI_SERVICE}}</center></td>
                            </tr>
                           
                            @endif
                        @endforeach
    </table>

                        
    <div class="coba">==================================================================</div>
    <div class="yay" style="font-size: 3pt;"> © {{ date('Y') }} - Toko Bagus . All rights reserved</div>

<center>
    <div class="terimakasih" style="margin-top:10px;">
    <div class="yay" style="margin-bottom:2px;" ><strong>TERIMA KASIH</strong></div>
    <div class="yay">*Pelanggan Wajib membawa nota saat pengambilan sepeda.</div>
    
    </div>
</center>
    
</body>
</html>