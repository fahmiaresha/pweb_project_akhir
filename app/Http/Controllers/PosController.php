<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class PosController extends Controller
{
    public function invoice_penjualan($id){
        $id_invoice=$id;
        $penjualan = DB::table('penjualan')->get();
        $product = DB::table('produk')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $users = DB::table('users')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        // return view('penjualan/invoice_penjualan',['id_invoice'=>$id_invoice,'penjualan'=>$penjualan
        // ,'product'=>$product,'pelanggan'=>$pelanggan,'users'=>$users,'detail_penjualan'=>$detail_penjualan
        // ,'kategori_pelanggan'=>$kategori_pelanggan,'kategori_produk'=>$kategori_produk]);
        $pdf = PDF::loadview('penjualan/invoice_penjualan',['id_invoice'=>$id_invoice,'penjualan'=>$penjualan
        ,'product'=>$product,'pelanggan'=>$pelanggan,'users'=>$users,'detail_penjualan'=>$detail_penjualan
        ,'kategori_pelanggan'=>$kategori_pelanggan,'kategori_produk'=>$kategori_produk]);
        return $pdf->stream();
        //ukuran 57 mm x 47 mm
        // 161,575
        // 133,228
        
        // 142,5
        // 117,5
        // $paper = array(0, 0,100,575,100,228   );
        // $pdf->setPaper($paper);
        // $pdf->setPaper($paper,'landscape');
        
    }

    public function show_data_penjualan(){
        $penjualan = DB::table('penjualan')->get();
        $product = DB::table('produk')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $users = DB::table('users')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        return view('penjualan/data_penjualan',['penjualan'=>$penjualan
        ,'product'=>$product,'pelanggan'=>$pelanggan,'users'=>$users,'detail_penjualan'=>$detail_penjualan
        ,'kategori_pelanggan'=>$kategori_pelanggan,'kategori_produk'=>$kategori_produk]);
    }

    public function show_pos(){
        $penjualan = DB::table('penjualan')->get();
        $product = DB::table('produk')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $users = DB::table('users')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $id_penjualan= DB::table('penjualan')->max('ID_PENJUALAN');
        $kategori_produk = DB::table('kategori_produk')->get();
        return view('penjualan/point_of_sales',['penjualan'=>$penjualan
        ,'product'=>$product,'pelanggan'=>$pelanggan,'users'=>$users,'id_penjualan'=>$id_penjualan
        ,'kategori_pelanggan'=>$kategori_pelanggan,'kategori_produk'=>$kategori_produk]);
    }

    // public function loadData(Request $request)
    // {
    //    $product=DB::table('produk')->where('NAMA_PRODUK','like','%'.$request->key.'%')->get();
    //    return response()->json(['product'=>$product]);
      
    // }

    public function store_pos(Request $request)
    {     
        // dd(request()->all());
          try{
            DB::beginTransaction();     
            $rp_string = $request->cash;
            $cash_fix = str_replace(".","",$rp_string);

            DB::table('penjualan')->insert([
                // 'ID_USER' => $request->nama_kasir ,
                // 'TANGGAL_PENJUALAN' => $request->tanggal_penjualan ,
                //sementara
                'ID_PELANGGAN' => $request->nama_pelanggan ,
                'ID_USER' => 1 ,
                'TOTAL_PENJUALAN' => $request->subtotal ,
                'KATEGORI_PELANGGAN_PENJUALAN' => $request->isi_kategori_pelanggan ,
                'CASH_PELANGGAN' => $cash_fix ,
                'CHANGE_PELANGGAN' => $request->change ,
                'CATATAN_PENJUALAN' => $request->catatan_penjualan 
            ]);          
    
                foreach($request['ID_PRODUK'] as $pr){
                    DB::table('detail_penjualan')->insert([
                        'ID_PENJUALAN' => $request->nota_id ,
                        'ID_PRODUK' => $pr ,
                        'JUMLAH_PRODUK' => $request['jumlah'][$pr] ,
                        'HARGA_PRODUK' => $request['selling_price'][$pr] ,
                        'TOTAL_HARGA_PRODUK' => $request['total'][$pr]
                    ]);     
                }
                DB::commit();
                return redirect('/point-of-sales')->with('insert','berhasil');
          }
          catch(Exception $exception){
              DB::rollBack();
              return redirect('/point-of-sales')->with('gagal','gagal');
           
          } 
    }
}
