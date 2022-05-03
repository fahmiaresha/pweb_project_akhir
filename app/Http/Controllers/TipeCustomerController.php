<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TipeCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function tampil_tipe_customer()
    {
        $tipe_customer = DB::table('tipe_user')->get();
        return view('tipe_customer',['tipe_customer'=>$tipe_customer]);
    }

    public function store_tipe_customer(Request $request)
    {
        $ht = $request->harga_tipe_customer;
        $x = str_replace("Rp.","",$ht);
        $harga_tipe_customer = str_replace(".","",$x);

        DB::table('tipe_user')->insert([
            'nama_tipe_user' => $request->nama_tipe_customer,
            'harga_tipe_user' => $harga_tipe_customer,
        ]);
        return redirect('/tipe-customer')->with('insert','berhasil');
    }

    public function update_tipe_customer(Request $request)
    {
        $ht = $request->harga_tipe_customer_update;
        $x = str_replace("Rp.","",$ht);
        $harga_tipe_customer = str_replace(".","",$x);

        DB::table('tipe_user')->where('id_tipe_user',$request->id)->update([
            'nama_tipe_user' => $request->nama_tipe_customer,
            'harga_tipe_user' => $harga_tipe_customer,
        ]);
        return redirect('/tipe-customer')->with('update','berhasil');  
    }

    public function delete_tipe_customer($id)
    {
        DB::table('tipe_user')->where('id_tipe_user',$id)->delete();
        return redirect('/tipe-customer')->with('delete','Data Berhasil Di
        Hapus');
    }
}
