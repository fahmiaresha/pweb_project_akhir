<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PenerimaanController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function show_penerimaan_barang(){

    }

    public function store_penerimaan_barang(Request $request)
    {     
        dd(request()->all());
        //   try{
            // DB::beginTransaction();     
            // DB::table('penerimaan_barang')->insert([
            //     'TANGGAL_NOTA' => $request->tanggal_nota,
            //     'NOMOR_NOTA' => $request->nomor_nota,
            //     'ID_USER' => $request->id_kasir,
            //     'CATATAN_PENERIMAAN_BARANG' => $request->catatan_penerimaan_barang,
            //     'FOTO_NOTA' => $request->file,
            //     'TOTAL_PENERIMAAN_BARANG' => 111,
            // ]);          
    
            //     foreach($request['ID_PRODUK'] as $pr){
            //         DB::table('detail_penerimaan_barang')->insert([
            //             'ID_PENERIMAAN_BARANG' => $request->id_penerimaan_barang,
            //             'ID_PRODUK' => $pr ,
            //             'ID_SUPPLIER' => $request['ID_SUPPLIER'][$pr] ,
            //             'TANGGAL_PEMBELIAN_PRODUK' => $request['TGL_PEMBELIAN'][$pr] ,
            //             'ID_KATEGORI_PRODUK' => $request['ID_KATEGORI_PRODUK'][$pr] ,
            //             'STOK_LAMA_PRODUK' => $request['STOK_PRODUK'][$pr] ,
            //             'JUMLAH_PRODUK_DITERIMA' => $request['jumlah'][$pr] ,
            //         ]);     
            //     }
                // DB::commit();
                // return redirect('/penerimaan-barang');
        //   }
        //   catch(\Exception $exception){
        //       DB::rollBack();
        //       return redirect('/penerimaan-barang')->with('gagal','gagal');
        //   } 
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
