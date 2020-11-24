<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PelangganController extends Controller
{
    public function tampil_dashboard(){

    }

    public function tampil_pelanggan(){
        $pelanggan = DB::table('pelanggan')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        return view('pelanggan/data_pelanggan',['pelanggan'=>$pelanggan,'kategori_pelanggan'=>$kategori_pelanggan]);
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
        return view('pelanggan/service_pelanggan',['pelanggan'=>$pelanggan,'service'=>$service]);
    }

    public function store_service_pelanggan(Request $request){
        DB::table('service')->insert(['ID_PELANGGAN' => $request->nama_pelanggan,
        'NAMA_SEPEDA_SERVICE' => $request->nama_sepeda,
        'DESKRIPSI_SERVICE' => $request->deskripsi_service
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
        $id_nota=$id;
        return view('pelanggan/nota_service',['pelanggan'=>$pelanggan,'kategori_pelanggan'=>$kategori_pelanggan
        ,'id_nota'=>$id_nota,'service'=>$service]);
      
    }

 

    public function tampil_pesanan_pelanggan(){
        
    }
}
