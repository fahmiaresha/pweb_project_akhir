<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SupplierController extends Controller

{

    public function send_wa_pesan_supplier(){


    }

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

    public function tampil_nota_supplier(){
        $supplier = DB::table('supplier')->get();
        $nota_supplier = DB::table('nota_supplier')->get();
        return view('supplier/nota_supplier',['supplier'=>$supplier,'nota_supplier'=>$nota_supplier]);
    }

    public function store_nota_supplier(Request $request){
        $this->validate($request, [
			'file' => 'required|file|image|mimes:jpeg,png,jpg',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');
        
        $nama_file = time()."_".$file->getClientOriginalName();
        
         // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);
        
        // echo $file;
        // echo '<br>';
        // echo $nama_file;

        $rp_string = $request->total_bayar;
        $x = str_replace("Rp.","",$rp_string);
        $total_bayar = str_replace(".","",$x);

        DB::table('nota_supplier')->insert([
        'ID_SUPPLIER' => $request->nama_supplier,
        'TOTAL_BAYAR_NOTA_SUPPLIER' =>$total_bayar,
        'FOTO_NOTA_SUPPLIER' => $nama_file
        ]);
        return redirect('/nota-supplier')->with('insert','berhasil');
    }

    public function update_nota_supplier(Request $request){

        $this->validate($request, [
			'file' => 'required|file|image|mimes:jpeg,png,jpg',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');
        
        $nama_file = time()."_".$file->getClientOriginalName();
        
         // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);
        
        // echo $file;
        // echo '<br>';
        // echo $nama_file;

        $rp_string = $request->total_bayar;
        $x = str_replace("Rp.","",$rp_string);
        $total_bayar = str_replace(".","",$x);
        echo $total_bayar;

        DB::table('nota_supplier')->where('ID_NOTA_SUPLIER',$request->id)->update([
            'ID_SUPPLIER' => $request->nama_supplier,
            'TOTAL_BAYAR_NOTA_SUPPLIER' =>$total_bayar,
            'FOTO_NOTA_SUPPLIER' => $nama_file
        ]);
        return redirect('/nota-supplier')->with('update','berhasil');
    }

    public function status_nota_supplier(Request $request)
    {
        $STATUS_ORDER_SUPPLIER= DB::table('nota_supplier')->where('ID_NOTA_SUPLIER',$request->id)->value('STATUS_NOTA_SUPPLIER');
          if($STATUS_ORDER_SUPPLIER==1){ 
             DB::table('nota_supplier')->where('ID_NOTA_SUPLIER',$request->id)->update([
                'STATUS_NOTA_SUPPLIER' => 0,
            ]);
          }
          else{
            DB::table('nota_supplier')->where('ID_NOTA_SUPLIER',$request->id)->update([
                'STATUS_NOTA_SUPPLIER' => 1,
            ]);
          }
          return redirect('/nota-supplier')->with('update_pesan','yay');
    }
}
