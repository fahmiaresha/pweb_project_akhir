<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
    }

    public function tampil_customer()
    {
        $customer = DB::table('users')->where('id','!=','1')->get();
        return view('customer',['customer'=>$customer]);
    }

    public function store_customer(Request $request)
    {
        // dd($request->all());
        if($request->hasFile('file')){
            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'foto_ktp';
		    $file->move($tujuan_upload,$nama_file);
        }

        DB::table('users')->insert(['no_ktp' => $request->nomor_ktp,
            'name' => $request->nama_lengkap,
            'umur' => $request->umur,
            'jenis_kelamin'=> $request->insert_jk,
            'telp'=> $request->telpon,
            'upload_ktp' => $nama_file
        ]);
        return redirect('/data-customer')->with('insert','berhasil');
    }

    public function update_customer(Request $request)
    {
        if($request->hasFile('file')){
           $file = $request->file('file');
           $nama_file = time()."_".$file->getClientOriginalName();
           $tujuan_upload = 'foto_ktp';
           $file->move($tujuan_upload,$nama_file);

           DB::table('users')->where('id',$request->id)->update([
                'no_ktp' => $request->nomor_ktp,
                'name' => $request->nama_lengkap,
                'umur' => $request->umur,
                'jenis_kelamin'=> $request->update_jk,
                'telp'=> $request->telpon,
                'upload_ktp' => $nama_file
            ]);
           return redirect('/data-customer')->with('update','berhasil');
       }
       else{
            DB::table('users')->where('id',$request->id)->update([
                'no_ktp' => $request->nomor_ktp,
                'name' => $request->nama_lengkap,
                'umur' => $request->umur,
                'jenis_kelamin'=> $request->update_jk,
                'telp'=> $request->telpon,
            ]);
           return redirect('/data-customer')->with('update','berhasil');
       }
    }

    public function delete_customer($id)
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect('/data-customer')->with('delete','Data Berhasil Di
        Hapus');
    }
   
}
