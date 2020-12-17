<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use PdfReport;
use ExcelReport;
use CSVReport;
use App\nota_supplier;
use App\penjualan;
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
        
        $fd=substr($y,0,10); 
        $fromDate=date("Y-m-d", strtotime($fd));
        // dump($fromDate);

        // "2020-12-13"
        $td=substr($y,11,21);
        $toDate=date("Y-m-d", strtotime($td));
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
        ['supplier'=>$supplier,'nota_supplier'=>$nota_supplier,'result'=>$result,'fromdate'=>$fromdate,'todate'=>$todate,'input_supplier'=>$input_supplier]); 
        return $pdf->stream();


    }


    public function laporan_penjualan(){
        $penjualan = DB::table('penjualan')->get();
        $produk = DB::table('produk')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $users = DB::table('users')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        return view('laporan/laporan_penjualan',['penjualan'=>$penjualan
        ,'pelanggan'=>$pelanggan,'users'=>$users,'detail_penjualan'=>$detail_penjualan
        ,'kategori_pelanggan'=>$kategori_pelanggan,'kategori_produk'=>$kategori_produk,'produk'=>$produk]);
    }

    public function search_laporan_penjualan(Request $request){
        $date = $request->input('daterangepicker');
        $input_produk = $request->input('produk');
        $product = DB::table('produk')->get();

        $y=str_replace(" ","",$date); //hilangkan space

        $fd=substr($y,0,10); 
        $fromDate=date("Y-m-d", strtotime($fd));
        // dump($fromDate);

        // "2020-12-13"
        $td=substr($y,11,21);
        $toDate=date("Y-m-d", strtotime($td));

        if($input_produk==null){
            $result=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$fromDate, $toDate])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();

            $produk_penjualan=DB::table('detail_penjualan')
                            ->select('ID_PRODUK',DB::raw('SUM(JUMLAH_PRODUK) AS TOTAL_PRODUK_DIJUAL'))
                            ->groupBy('ID_PRODUK')
                            ->orderBy('TOTAL_PRODUK_DIJUAL', 'DESC')
                            ->whereBetween('TANGGAL_PENJUALAN',[$fromDate, $toDate])
                            ->limit(5)->get();
        }
        else{
            $result=penjualan::select(['penjualan.ID_PENJUALAN','penjualan.TANGGAL_PENJUALAN','detail_penjualan.TOTAL_HARGA_PRODUK','penjualan.KATEGORI_PELANGGAN_PENJUALAN', 'penjualan.ID_USER']) // Do some querying..
            ->join('detail_penjualan', 'detail_penjualan.ID_PENJUALAN', '=', 'penjualan.ID_PENJUALAN')
            ->whereBetween('penjualan.TANGGAL_PENJUALAN_ASLI', [$fromDate, $toDate])
            ->orderBy('penjualan.ID_PENJUALAN', 'ASC')
            ->where('detail_penjualan.ID_PRODUK',$input_produk)
            ->get();

            $produk_penjualan=DB::table('detail_penjualan')
                            ->select('ID_PRODUK',DB::raw('SUM(JUMLAH_PRODUK) AS TOTAL_PRODUK_DIJUAL'))
                            ->groupBy('ID_PRODUK')
                            ->orderBy('TOTAL_PRODUK_DIJUAL', 'DESC')
                            ->whereBetween('TANGGAL_PENJUALAN',[$fromDate, $toDate])
                            ->where('ID_PRODUK',$input_produk)
                            ->limit(5)->get();
        }

       
        

                            // ->where('ID_PRODUK',$input_supplier)

        if($result=='[]'){
            return Redirect::back()->with('search_kosong','yay');
        }
        else{
            return Redirect::back()->with(['fromDate'=>$fromDate,'toDate'=>$toDate,'sukses'=>$result,'produk_penjualan'=>$produk_penjualan,'product'=>$product,'input_produk'=>$input_produk]);
        }  
    }

    public function pdf_penjualan($fromdate,$todate,$input_produk){
        $penjualan = DB::table('penjualan')->get();
        $product = DB::table('produk')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $users = DB::table('users')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        $kategori_produk = DB::table('kategori_produk')->get();

        if($input_produk=='kosong'){
                $result=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
                ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$fromdate, $todate])
                ->orderBy('ID_PENJUALAN', 'ASC')
                ->get();
        }
        else{
                $result=penjualan::select(['penjualan.ID_PENJUALAN','penjualan.TANGGAL_PENJUALAN','detail_penjualan.TOTAL_HARGA_PRODUK','penjualan.KATEGORI_PELANGGAN_PENJUALAN', 'penjualan.ID_USER']) // Do some querying..
                ->join('detail_penjualan', 'detail_penjualan.ID_PENJUALAN', '=', 'penjualan.ID_PENJUALAN')
                ->whereBetween('penjualan.TANGGAL_PENJUALAN_ASLI', [$fromdate, $todate])
                ->orderBy('penjualan.ID_PENJUALAN', 'ASC')
                ->where('detail_penjualan.ID_PRODUK',$input_produk)
                ->get();
        }

        
       $pdf = PDF::loadview('laporan/pdf_penjualan',['penjualan'=>$penjualan
        ,'product'=>$product,'pelanggan'=>$pelanggan,'users'=>$users,'detail_penjualan'=>$detail_penjualan
        ,'kategori_pelanggan'=>$kategori_pelanggan,'kategori_produk'=>$kategori_produk,'result'=>$result,'fromdate'=>$fromdate,'todate'=>$todate,'input_produk'=>$input_produk]);
        return $pdf->stream();
    }


}
