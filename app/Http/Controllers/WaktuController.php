<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WaktuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function tampil_waktu(){
        $waktu = DB::table('waktu')->get();
        return view('waktu',['waktu'=>$waktu]);
    }

    public function store_waktu(Request $request){
        DB::table('waktu')->insert([
            'jam' => $request->waktu,
        ]);
        return redirect('/waktu')->with('insert','berhasil');
    }

    public function update_waktu(Request $request){
        DB::table('waktu')->where('id_waktu',$request->id)->update([
            'jam' => $request->waktu,
        ]);
        return redirect('/waktu')->with('update','berhasil');
    }

    public function delete_waktu($id){
        DB::table('waktu')->where('id_waktu',$id)->delete();
        return redirect('/waktu')->with('delete','Data Berhasil Di
        Hapus');
    }
   

}
