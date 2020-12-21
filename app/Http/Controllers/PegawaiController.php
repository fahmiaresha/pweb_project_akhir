<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PegawaiController extends Controller
{
    public function data_pegawai(){
        $pegawai = DB::table('users')->get();
        $jabatan = DB::table('jabatan')->get();
        // dump($pegawai);
        return view('pegawai/data_pegawai',['pegawai'=>$pegawai,'jabatan'=>$jabatan]);
    }

    public function store_pegawai(){
      
    }

    public function update_status_pegawai(Request $request){
        // dd($request->all());
        $status_akun= DB::table('users')->where('id',$request->id_user)->value('status_akun');
        // dump($status_akun);
        if($status_akun==1){ 
            // echo 'masuk if ==1';
           DB::table('users')->where('status_akun',$request->id)->update([
              'status_akun' => 0,
          ]);
        }
        else{
            // echo 'masuk else ==';
          DB::table('users')->where('status_akun',$request->id)->update([
              'status_akun' => 1,
              'alamat_user'=> 'ganti alamat'
          ]);
        }
        return redirect('/pegawai')->with('update_status','yay');
    }

    public function update_pegawai(){
      
    }

    public function delete_pegawai(){
      
    }

    

}
