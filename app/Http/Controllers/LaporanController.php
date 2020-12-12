<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use PdfReport;
use ExcelReport;
use CSVReport;
use App\nota_supplier;

class LaporanController extends Controller
{
    public function laporan_nota_supplier(){
        $supplier = DB::table('supplier')->get();
        $nota_supplier = DB::table('nota_supplier')->get();
        return view('laporan/laporan_nota_supplier',['supplier'=>$supplier,'nota_supplier'=>$nota_supplier]);        
    }

    public function search_nota_supplier(Request $request){
        $supplier = DB::table('supplier')->get();
        $nota_supplier = DB::table('nota_supplier')->get();
        $date = $request->input('daterangepicker');
        // 2020-12-12-2020-12-13
        $y=str_replace(" ","",$date); //hilangkan space
        
        // "2020-12-12"
        $fromDate=substr($y,0,10); 
        // dump($fromDate);

        // "2020-12-13"
        $toDate=substr($y,11,21);
        // dump($toDate); 
    
        // $sortBy = $request->input('sort_by');

        $query = nota_supplier::select(['STATUS_NOTA_SUPPLIER','TANGGAL_NoTA_DATANG','ID_SUPPLIER', 'TOTAL_BAYAR_NOTA_SUPPLIER']) // Do some querying..
                        ->whereBetween('TANGGAL_NOTA_DATANG', [$fromDate, $toDate])
                        ->orderBy('STATUS_NOTA_SUPPLIER', 'ASC')
                        ->get();
                        // ->orderBy($sortBy);
        // dump($query);
        // return view('laporan/laporan_nota_supplier',['supplier'=>$supplier,'nota_supplier'=>$nota_supplier,'query'=>$query]);
        return redirect('/laporan-nota-supplier')->with('search_sukses',$query,$supplier,$nota_supplier);
        // if($query!=null){
        // }
        // else{
        //     return redirect('/laporan-nota-supplier')->with('search_kosong');
        // }
        
    }


    public function laporan_penjualan(){
        $penjualan = DB::table('penjualan')->get();
        $product = DB::table('produk')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $users = DB::table('users')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        return view('laporan/laporan_penjualan',['penjualan'=>$penjualan
        ,'product'=>$product,'pelanggan'=>$pelanggan,'users'=>$users,'detail_penjualan'=>$detail_penjualan
        ,'kategori_pelanggan'=>$kategori_pelanggan,'kategori_produk'=>$kategori_produk]);
    }


}
