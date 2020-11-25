<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SupplierController extends Controller

{
    public function tampil_supplier(){
        $supplier = DB::table('supplier')->get();
        // dump($supplier);
        return view('supplier/data_supplier',['supplier'=>$supplier]);
    }

    public function store_supplier(Request $request){
        DB::table('supplier')->insert(['NAMA_SUPPLIER' => $request->nama_supplier,
        'ALAMAT_SUPPLIER' => $request->alamat_supplier,
        'TELP_SUPPLIER' => $request->telepon_supplier,
        'EMAIL_SUPPLIER'=> $request->email_supplier,
        ]);
        return redirect('/data-supplier')->with('insert','berhasil');
    }

    public function update_supplier(Request $request){
        DB::table('supplier')->where('ID_SUPPLIER',$request->id)->update([
            'NAMA_SUPPLIER' => $request->nama_supplier,
            'ALAMAT_SUPPLIER' => $request->alamat_supplier,
            'TELP_SUPPLIER' => $request->telepon_supplier,
            'EMAIL_SUPPLIER'=> $request->email_supplier,
        ]);
        return redirect('/data-supplier')->with('update','berhasil');
    }

    public function delete_supplier($id)
    {
        DB::table('supplier')->where('ID_SUPPLIER',$id)->delete();
        return redirect('/data-supplier')->with('delete','Data Berhasil Di
        Hapus');
    }

    public function tampil_pesan_supplier(){
        $supplier = DB::table('supplier')->get();
        $catatan_order_supplier = DB::table('catatan_order_supplier')->get();
        // dump($supplier);
        return view('supplier/order_supplier',['supplier'=>$supplier,
        'catatan_order_supplier'=>$catatan_order_supplier]);
    }

    public function store_pesan_supplier(Request $request){
        DB::table('catatan_order_supplier')->insert(['ID_SUPPLIER' => $request->nama_supplier,
        'DESKRIPSI_CATATAN_ORDER_SUPPLIER' => $request->deskripsi
        ]);
        return redirect('/pesan-supplier')->with('insert','berhasil');
    }

    public function update_pesan_supplier(Request $request){
        DB::table('catatan_order_supplier')->where('ID_CATATAN_ORDER_SUPPLIER',$request->id)->update([
            'ID_SUPPLIER' => $request->nama_supplier,
        'DESKRIPSI_CATATAN_ORDER_SUPPLIER' => $request->deskripsi
        ]);
        return redirect('/pesan-supplier')->with('update','berhasil');
    }

    public function status_pesan_supplier(Request $request)
    {
        $STATUS_ORDER_SUPPLIER= DB::table('catatan_order_supplier')->where('ID_CATATAN_ORDER_SUPPLIER',$request->id)->value('STATUS_ORDER_SUPPLIER');
          if($STATUS_ORDER_SUPPLIER==1){ 
             DB::table('catatan_order_supplier')->where('ID_CATATAN_ORDER_SUPPLIER',$request->id)->update([
                'STATUS_ORDER_SUPPLIER' => 0,
            ]);
          }
          else{
            DB::table('catatan_order_supplier')->where('ID_CATATAN_ORDER_SUPPLIER',$request->id)->update([
                'STATUS_ORDER_SUPPLIER' => 1,
            ]);
          }
          return redirect('/pesan-supplier')->with('update_pesan','yay');
    }
}
