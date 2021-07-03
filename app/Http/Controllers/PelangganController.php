<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use PDF;

class PelangganController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    

    public function send_wa_pesanan_pelanggan(Request $request){
        // dd($request->all());
        
        $nomor2 = $request->nomor_whatsapp;
        // $nomor3 = $nomor2[0];
        // $nomor3 = substr($nomor2,0,1);

        // $nomor = str_replace($nomor3,"62",$nomor2);
        $nomor = substr_replace($nomor2,"62",0,1);
        // dd($nomor);
        // echo $nomor;
        $pesan = $request->pesan_whatsapp;

        // $url_wa ='https://api.whatsapp.com/send?phone=+$nomor&text=$pesan&source=&data=';

        $url2="https://api.whatsapp.com/send?phone=+";
        $url3=$nomor;
        $url4="&text=";
        $url5=$pesan;
        $url6="&source=&data=";

        DB::table('catatan_pre_order_pelanggan')->where('ID_CATATAN_PRE_ORDER_PELANGGAN',$request->id)
        ->update(['STATUS_PRE_ORDER' => 1 ]);

        DB::table('whatsapp')->insert(['PESAN_WHATSAPP' => $pesan,
        'NO_WHATSAPP' => $nomor2,
        'KATEGORI_WHATSAPP' => "Pelanggan",
        ]);

        $url = $url2.$url3.$url4.$url5.$url6;
        return Redirect::to($url);
    }

    public function tampil_pelanggan(){
        $pelanggan = DB::table('pelanggan')->get();
        $service = DB::table('service')->get();
        $catatan_pre_order_pelanggan = DB::table('catatan_pre_order_pelanggan')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $penjualan=DB::table('penjualan')->get();
        return view('pelanggan/data_pelanggan',['pelanggan'=>$pelanggan,
        'kategori_pelanggan'=>$kategori_pelanggan,'service'=>$service,
        'catatan_pre_order_pelanggan'=>$catatan_pre_order_pelanggan,'penjualan'=>$penjualan]);
    }

    public function store_pelanggan(Request $request){
        
        DB::table('pelanggan')->insert(['ID_KATEGORI_PELANGGAN' => $request->kategori,
        'NAMA_PELANGGAN' => $request->nama,
        'ALAMAT_PELANGGAN' => $request->alamat,
        'TELP_PELANGGAN'=> $request->telp,
        ]);
        return redirect('/data-pelanggan')->with('insert','berhasil');
    }

    public function update_pelanggan(Request $request){
        DB::table('pelanggan')->where('ID_PELANGGAN',$request->id)->update([
            'ID_KATEGORI_PELANGGAN' => $request->kategori,
            'NAMA_PELANGGAN' => $request->nama,
            'ALAMAT_PELANGGAN' => $request->alamat,
            'TELP_PELANGGAN'=> $request->telp,
        ]);
        return redirect('/data-pelanggan')->with('update','berhasil');
    }

    public function delete_pelanggan($id)
    {
        DB::table('pelanggan')->where('ID_PELANGGAN',$id)->delete();
        return redirect('/data-pelanggan')->with('delete','Data Berhasil Di
        Hapus');
    }

    public function tampil_kategori_pelanggan(){
        $pelanggan = DB::table('pelanggan')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        return view('pelanggan/kategori_pelanggan',['pelanggan'=>$pelanggan,'kategori_pelanggan'=>$kategori_pelanggan]);
    }

    public function store_kategori_pelanggan(Request $request){
        DB::table('kategori_pelanggan')->insert(['NAMA_KATEGORI_PELANGGAN' => $request->kategori_pelanggan,
        ]);
        return redirect('/kategori-pelanggan')->with('insert','berhasil');
    }

    public function update_kategori_pelanggan(Request $request){
        DB::table('kategori_pelanggan')->where('ID_KATEGORI_PELANGGAN',$request->id)->update([
            'NAMA_KATEGORI_PELANGGAN' => $request->kategori_pelanggan,
        ]);
        return redirect('/kategori-pelanggan')->with('update','berhasil');
    }

    public function delete_kategori_pelanggan($id)
    {
        DB::table('kategori_pelanggan')->where('ID_KATEGORI_PELANGGAN',$id)->delete();
        return redirect('/kategori-pelanggan')->with('delete','Data Berhasil Di
        Hapus');
    }

    public function tampil_service_pelanggan(){
        $pelanggan = DB::table('pelanggan')->get();
        $service = DB::table('service')->get();
        $users = DB::table('users')->get();
        return view('pelanggan/service_pelanggan',['pelanggan'=>$pelanggan,'service'=>$service,'users'=>$users]);
    }

    public function store_service_pelanggan(Request $request){
        DB::table('service')->insert(['ID_PELANGGAN' => $request->nama_pelanggan,
        'NAMA_SEPEDA_SERVICE' => $request->nama_sepeda,
        'DESKRIPSI_SERVICE' => $request->deskripsi_service,
        'PEGAWAI' => $request->nama_user
        ]);
        return redirect('/service-pelanggan')->with('insert','berhasil');
    }

    public function update_service_pelanggan(Request $request){
        DB::table('service')->where('ID_SERVICE',$request->id)->update([
            'ID_PELANGGAN' => $request->nama_pelanggan,
            'NAMA_SEPEDA_SERVICE' => $request->nama_sepeda,
            'DESKRIPSI_SERVICE' => $request->deskripsi_service
        ]);
        return redirect('/service-pelanggan')->with('update','berhasil');
    }

    public function print_service_pelanggan($id){
        $pelanggan = DB::table('pelanggan')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $service = DB::table('service')->get();
        $users = DB::table('users')->get();
        $id_invoice=$id;
        // return view('pelanggan/invoice_service',['pelanggan'=>$pelanggan,'kategori_pelanggan'=>$kategori_pelanggan
        // ,'id_invoice'=>$id_invoice,'service'=>$service]);

        $pdf = PDF::loadview('pelanggan/invoice_service',['pelanggan'=>$pelanggan,'kategori_pelanggan'=>$kategori_pelanggan
        ,'id_invoice'=>$id_invoice,'service'=>$service,'users'=>$users]);
        return $pdf->stream();
      
    }

    public function status_service_pelanggan(Request $request)
    {
        $status_service= DB::table('service')->where('ID_SERVICE',$request->id)->value('STATUS_SERVICE');
          if($status_service==1){ 
             DB::table('service')->where('ID_SERVICE',$request->id)->update([
                'STATUS_SERVICE' => 0,
            ]);
          }
          else{
            DB::table('service')->where('ID_SERVICE',$request->id)->update([
                'STATUS_SERVICE' => 1,
            ]);
          }
          return redirect('/service-pelanggan')->with('update_service','yay');
    }

 

    public function tampil_pesanan_pelanggan(){
        $pelanggan = DB::table('pelanggan')->get();
        $pre_order = DB::table('catatan_pre_order_pelanggan')->get();
        // dump($pre_order);
        return view('pelanggan/pesanan_pelanggan',['pelanggan'=>$pelanggan,'pre_order'=>$pre_order]);
    }

    public function store_pesanan_pelanggan(Request $request){
        $string = trim(preg_replace('/\s+/', ' ', $request->deskripsi));
        DB::table('catatan_pre_order_pelanggan')->insert(['ID_PELANGGAN' => $request->nama_pelanggan,
        'DESKRIPSI_CATATAN_PRE_ODER_PELANGGAN' => $string,
        ]);
        return redirect('/pesanan-pelanggan')->with('insert','berhasil');
    }

    public function update_pesanan_pelanggan(Request $request){
        $string = trim(preg_replace('/\s+/', ' ', $request->deskripsi));
        DB::table('catatan_pre_order_pelanggan')->where('ID_CATATAN_PRE_ORDER_PELANGGAN',$request->id)->update([
            'ID_PELANGGAN' => $request->nama_pelanggan,
            'DESKRIPSI_CATATAN_PRE_ODER_PELANGGAN' => $string,
        ]);
        return redirect('/pesanan-pelanggan')->with('update','berhasil');
    }

    
    public function status_pesan_pelanggan(Request $request)
    {
        $STATUS_PRE_ORDER= DB::table('catatan_pre_order_pelanggan')->where('ID_CATATAN_PRE_ORDER_PELANGGAN',$request->id)->value('STATUS_PRE_ORDER');
          if($STATUS_PRE_ORDER==1){ 
             DB::table('catatan_pre_order_pelanggan')->where('ID_CATATAN_PRE_ORDER_PELANGGAN',$request->id)->update([
                'STATUS_PRE_ORDER' => 0,
            ]);
          }
          else{
            DB::table('catatan_pre_order_pelanggan')->where('ID_CATATAN_PRE_ORDER_PELANGGAN',$request->id)->update([
                'STATUS_PRE_ORDER' => 1,
            ]);
          }
          return redirect('/pesanan-pelanggan')->with('update_pesan','yay');
    }


   
}
