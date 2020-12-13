<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use PdfReport;
use ExcelReport;
use CSVReport;
use App\nota_supplier;
use Redirect;

class LaporanController extends Controller
{
    public function laporan_nota_supplier(){
        $supplier = DB::table('supplier')->get();
        $nota_supplier = DB::table('nota_supplier')->get();
        return view('laporan/laporan_nota_supplier',['supplier'=>$supplier,'nota_supplier'=>$nota_supplier]);        
    }

    public function search_nota_supplier(Request $request){
        $date = $request->input('daterangepicker');
        $input_supplier = $request->input('supplier');
        // 2020-12-12-2020-12-13
        $y=str_replace(" ","",$date); //hilangkan space
        
        // "2020-12-12"
        $fromDate=substr($y,0,10); 
        // dump($fromDate);

        // "2020-12-13"
        $toDate=substr($y,11,21);
        // dump($toDate); 

        if($input_supplier==null){
            $result=nota_supplier::select(['STATUS_NOTA_SUPPLIER','NOMOR_NOTA_SUPPLIER','TANGGAL_NOTA_DATANG','ID_SUPPLIER', 'TOTAL_BAYAR_NOTA_SUPPLIER']) // Do some querying..
                    ->whereBetween('TANGGAL_NOTA_DATANG', [$fromDate, $toDate])
                    ->orderBy('STATUS_NOTA_SUPPLIER', 'ASC')
                    ->get();
            }
        else{
            $result=nota_supplier::select(['STATUS_NOTA_SUPPLIER','NOMOR_NOTA_SUPPLIER','TANGGAL_NOTA_DATANG','ID_SUPPLIER', 'TOTAL_BAYAR_NOTA_SUPPLIER']) // Do some querying..
            ->whereBetween('TANGGAL_NOTA_DATANG', [$fromDate, $toDate])
            ->orderBy('STATUS_NOTA_SUPPLIER', 'ASC')
            ->where('ID_SUPPLIER',$input_supplier)
            ->get();
        }
       
        // dump($result);
       
        if($result=='[]'){
            return Redirect::back()->with('search_kosong','yay');
        }
        else{
            return Redirect::back()->with(['fromDate'=>$fromDate,'toDate'=>$toDate,'sukses'=>$result,'input_supplier'=>$input_supplier]);
        }         
    }


    public function pdf_nota_supplier($fromdate,$todate,$input_supplier){
        $supplier = DB::table('supplier')->get();
        $nota_supplier = DB::table('nota_supplier')->get();

        if($input_supplier=='kosong'){
            $result=nota_supplier::select(['STATUS_NOTA_SUPPLIER','NOMOR_NOTA_SUPPLIER','TANGGAL_NOTA_DATANG','ID_SUPPLIER', 'TOTAL_BAYAR_NOTA_SUPPLIER']) // Do some querying..
            ->whereBetween('TANGGAL_NOTA_DATANG', [$fromdate, $todate])
            ->orderBy('STATUS_NOTA_SUPPLIER', 'ASC')
            ->get();
        }
        else{
            $result=nota_supplier::select(['STATUS_NOTA_SUPPLIER','NOMOR_NOTA_SUPPLIER','TANGGAL_NOTA_DATANG','ID_SUPPLIER', 'TOTAL_BAYAR_NOTA_SUPPLIER']) // Do some querying..
            ->whereBetween('TANGGAL_NOTA_DATANG', [$fromdate, $todate])
            ->orderBy('STATUS_NOTA_SUPPLIER', 'ASC')
            ->where('ID_SUPPLIER',$input_supplier)
            ->get();
        }

        $pdf = PDF::loadview('laporan/pdf_nota_supplier',
        ['supplier'=>$supplier,'nota_supplier'=>$nota_supplier,'result'=>$result,'fromdate'=>$fromdate,'todate'=>$todate]); 
        return $pdf->stream();


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

        // return view('laporan/laporan_penjualan');
    }


}
