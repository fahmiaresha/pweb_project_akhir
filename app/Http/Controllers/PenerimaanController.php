<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PenerimaanController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store_produk(Request $request){
        if($request->hasFile('file')){
            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'foto_produk';
		    $file->move($tujuan_upload,$nama_file);
        }

        $hb = $request->harga_beli;
        $x = str_replace("Rp.","",$hb);
        $harga_beli = str_replace(".","",$x);

        $hr = $request->harga_jual_reseller;
        $y = str_replace("Rp.","",$hr);
        $harga_jual_reseller = str_replace(".","",$y);

        $hj = $request->harga_jual;
        $y = str_replace("Rp.","",$hj);
        $harga_jual = str_replace(".","",$y);

        DB::table('produk')->insert(['ID_SUPPLIER' => $request->supplier,
        'ID_KATEGORI_PRODUK' => $request->kategori,
        'NAMA_PRODUK' => $request->nama,
        'TANGGAL_PEMBELIAN_PRODUK'=> $request->daterangepicker,
        'STOK_PRODUK'=> $request->stok,
        'HARGA_BELI_PRODUK'=> $harga_beli,
        'HARGA_JUAL_RESELLER_PRODUK'=> $harga_jual_reseller,
        'HARGA_JUAL_PELANGGAN_PRODUK'=> $harga_jual,
        'DESKRIPSI_PRODUK'=> $request->deskripsi_produk,
        'FOTO_PRODUK' => $nama_file
        ]);
        return redirect('/penerimaan-barang')->with('insert_produk','sukses');
    }

    public function show_penerimaan_barang(){
        $supplier= DB::table('supplier')->get();
        $product = DB::table('produk')->get();
        $users = DB::table('users')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        $penerimaan_barang = DB::table('penerimaan_barang')->get();
        $detail_penerimaan_barang = DB::table('detail_penerimaan_barang')->get();
        

        return view('penerimaan_barang/data_penerimaan_barang',['supplier'=>$supplier
        ,'product'=>$product,'users'=>$users,'penerimaan_barang'=>$penerimaan_barang
        ,'kategori_produk'=>$kategori_produk,'detail_penerimaan_barang'=>$detail_penerimaan_barang
        ]);
    }

    public function store_penerimaan_barang(Request $request)
    {     
        // dd(request()->all());
        if($request->hasFile('file')){
            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'foto_penerimaan_barang';
		    $file->move($tujuan_upload,$nama_file);
        }
        else{
            $nama_file="";
        }
        
          try{
            DB::beginTransaction();     
     
                foreach($request['ID_PRODUK'] as $pr){
                    DB::table('detail_penerimaan_barang')->insert([
                        'ID_PENERIMAAN_BARANG' => $request->id_penerimaan_barang,
                        'ID_PRODUK' => $pr ,
                        'ID_SUPPLIER' => $request['ID_SUPPLIER'][$pr] ,
                        'TANGGAL_PEMBELIAN_PRODUK' => $request['TGL_PEMBELIAN'][$pr] ,
                        'ID_KATEGORI_PRODUK' => $request['ID_KATEGORI_PRODUK'][$pr] ,
                        'STOK_LAMA_PRODUK' => $request['STOK_PRODUK'][$pr] ,
                        'JUMLAH_PRODUK_DITERIMA' => $request['jumlah'][$pr] ,
                        'STOK_BARU_PRODUK' => $request['STOK_PRODUK'][$pr] + $request['jumlah'][$pr] ,
                    ]);     
                    //update-produk-stok
                    DB::table('produk')->where('ID_PRODUK',$pr)->update([
                        'STOK_PRODUK'=> $request['STOK_PRODUK'][$pr] + $request['jumlah'][$pr]
                    ]);
                }


                $jumlah_produk_diterima=0;
                foreach($request['ID_PRODUK'] as $pr){
                        $jumlah_produk_diterima= $jumlah_produk_diterima + $request['jumlah'][$pr];
                }

                DB::table('penerimaan_barang')->insert([
                    'TANGGAL_NOTA' => $request->tanggal_nota,
                    'NOMOR_NOTA' => $request->nomor_nota,
                    'ID_USER' => $request->id_kasir,
                    'CATATAN_PENERIMAAN_BARANG' => $request->catatan_penerimaan_barang,
                    'FOTO_NOTA' => $nama_file,
                    'TOTAL_PENERIMAAN_BARANG' => $jumlah_produk_diterima,
                ]);

               

                DB::commit();
                return redirect('/penerimaan-barang')->with('insert','sukses');
          }
          catch(\Exception $exception){
              DB::rollBack();
              return redirect('/penerimaan-barang')->with('gagal','gagal');
          } 
    }

    public function get_supplier($id){
        $produk = DB::table("produk")->where("ID_SUPPLIER",$id)->get();
        return json_encode($produk);
    }

    public function input_penerimaan_barang(){
        $supplier= DB::table('supplier')->get();
        $product = DB::table('produk')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $users = DB::table('users')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $id_penjualan= DB::table('penjualan')->max('ID_PENJUALAN');
        $kategori_produk = DB::table('kategori_produk')->get();
        $penerimaan_barang = DB::table('penerimaan_barang')->count();
        $total_penerimaan_barang = $penerimaan_barang + 1;

        return view('penerimaan_barang/input_penerimaan_barang',['supplier'=>$supplier
        ,'product'=>$product,'pelanggan'=>$pelanggan,'users'=>$users,'id_penjualan'=>$id_penjualan
        ,'kategori_pelanggan'=>$kategori_pelanggan,'kategori_produk'=>$kategori_produk,'total_penerimaan_barang'=>$total_penerimaan_barang]);
    }
}
