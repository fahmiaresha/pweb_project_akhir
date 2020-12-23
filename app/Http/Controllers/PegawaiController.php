<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function data_pegawai(){
        $pegawai = DB::table('users')->get();
        $jabatan = DB::table('jabatan')->get();
        // dump($pegawai);
        return view('pegawai/data_pegawai',['pegawai'=>$pegawai,'jabatan'=>$jabatan]);
    }

    public function store_pegawai(Request $request){
        
        $pw = $request->password;
        $repeat_pw = $request->repeat_password;


        if($pw == $repeat_pw){
            $password = Hash::make($pw);
            try{
                DB::table('users')->insert(['ID_JABATAN' => $request->jabatan,
                    'name' => $request->nama,
                    'alamat_user' => $request->alamat,
                    'email' => $request->email,
                    'password' => $password,
                    'telp_user' => $request->telpon
                ]);
                return redirect('/pegawai')->with('insert','yay');
            }
            catch(\Exception $e){
                // return $e->getMessage();
                return redirect('/pegawai')->with('email_sama','error');
            }
        }
        else{
            return redirect('/pegawai')->with('password_tdk_cocok','gagal');
        }
    }

    public function update_status_pegawai(Request $request){
        // dd($request->all());
        $status_akun= DB::table('users')->where('id',$request->id_user)->value('status_akun');
        // dump($status_akun);
        if($status_akun==1){ 
            // echo 'masuk if ==1';
           DB::table('users')->where('id',$request->id_user)->update([
              'status_akun' => 0,
          ]);
        }
        else{
            // echo 'masuk else ==';
          DB::table('users')->where('id',$request->id_user)->update([
              'status_akun' => 1,
            //   'alamat_user'=> 'ganti alamat'
          ]);
        }
        return redirect('/pegawai')->with('update_status','yay');
    }

    public function update_pegawai(Request $request){
        $pw = $request->password;
        $repeat_pw = $request->repeat_password;
            // if($pw == $repeat_pw){
                $password = Hash::make($pw);
                try{
                    DB::table('users')->where('id',$request->id)->update([
                        'ID_JABATAN' => $request->jabatan,
                        'name' => $request->nama,
                        'alamat_user' => $request->alamat,
                        'email' => $request->email,
                        'password' => $password,
                        'telp_user' => $request->telpon
                    ]);
                    return redirect('/pegawai')->with('update','berhasil');
                }
                catch(\Exception $e){
                    // return $e->getMessage();
                    return redirect('/pegawai')->with('email_sama','error');
                }
                
            // }
            // else{
            //     return redirect('/pegawai')->with('password_tdk_cocok','gagal');
            // }
    }

    public function delete_pegawai($id){
        DB::table('users')->where('id',$id)->delete();
        return redirect('/pegawai')->with('delete','Hapus');
    }

    

}
