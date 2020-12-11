<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function tampil_data_produk(){
        $produk = DB::table('produk')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        $supplier = DB::table('supplier')->get();
        // dump($produk);
        return view('produk/data_produk',['produk'=>$produk,'kategori_produk'=>$kategori_produk
        ,'supplier'=>$supplier]);
    }

    public function store_produk(Request $request){
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
        ]);
        return redirect('/data-produk')->with('insert','berhasil');
    }

    public function update_produk(Request $request){
        $hb = $request->harga_beli;
        $x = str_replace("Rp.","",$hb);
        $update_harga_beli = str_replace(".","",$x);

        $hr = $request->harga_jual_reseller;
        $y = str_replace("Rp.","",$hr);
        $update_harga_jual_reseller = str_replace(".","",$y);

        $hj = $request->harga_jual;
        $y = str_replace("Rp.","",$hj);
        $update_harga_jual = str_replace(".","",$y);

        DB::table('produk')->where('ID_PRODUK',$request->id)->update([
            'ID_SUPPLIER' => $request->supplier,
            'ID_KATEGORI_PRODUK' => $request->kategori,
            'NAMA_PRODUK' => $request->nama,
            'TANGGAL_PEMBELIAN_PRODUK'=> $request->daterangepicker,
            'STOK_PRODUK'=> $request->stok,
            'HARGA_BELI_PRODUK'=> $update_harga_beli,
            'HARGA_JUAL_RESELLER_PRODUK'=> $update_harga_jual_reseller,
            'HARGA_JUAL_PELANGGAN_PRODUK'=> $update_harga_jual,
            'DESKRIPSI_PRODUK'=> $request->deskripsi_produk,
        ]);
        return redirect('/data-produk')->with('update','berhasil');
    }

    public function delete_produk($id)
    {
        DB::table('produk')->where('ID_PRODUK',$id)->delete();
        return redirect('/data-produk')->with('delete','Data Berhasil Di
        Hapus');
    }

    public function tampil_kategori_produk(){
        $produk = DB::table('produk')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        return view('produk/kategori_produk',['kategori_produk'=>$kategori_produk,'produk'=>$produk]);
    }

    public function store_kategori_produk(Request $request){
        DB::table('kategori_produk')->insert(['NAMA_KATEGORI_PRODUK' => $request->kategori_produk
        ]);
        return redirect('/kategori-produk')->with('insert','berhasil');
    }

    public function update_kategori_produk(Request $request){
        DB::table('kategori_produk')->where('ID_KATEGORI_PRODUK',$request->id)->update([
            'NAMA_KATEGORI_PRODUK' => $request->kategori_produk
        ]);
        return redirect('/kategori-produk')->with('update','berhasil');
    }

    public function delete_kategori_produk($id){
        DB::table('kategori_produk')->where('ID_KATEGORI_PRODUK',$id)->delete();
        return redirect('/kategori-produk')->with('delete','Data Berhasil Di
        Hapus');
    }
}
