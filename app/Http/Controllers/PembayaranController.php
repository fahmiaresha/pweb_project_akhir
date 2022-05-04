<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function tampil_pembayaran(){
        $pembayaran = DB::table('pembayaran')->get();
        $pemesanan =  DB::table('pemesanan')
                      ->join('users','users.id','=','pemesanan.id_user')
                      ->get();
        return view('pembayaran',['pembayaran'=>$pembayaran,'pemesanan'=>$pemesanan]);
    }

    public function store_pembayaran(Request $request){
        if($request->hasFile('file')){
            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'foto_pembayaran';
		    $file->move($tujuan_upload,$nama_file);
        }

        DB::table('pembayaran')->insert(['id_pemesanan' => $request->id_pemesanan,
            'tipe_pembayaran' => $request->tipe_pembayaran,
            'upload_bukti_transfer' => $nama_file,
        ]);
        return redirect('/pembayaran')->with('insert','berhasil');
    }

    public function update_pembayaran(Request $request){
        if($request->hasFile('file')){
            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'foto_pembayaran';
            $file->move($tujuan_upload,$nama_file);
 
            DB::table('pembayaran')->where('id_pemesanan',$request->id)->update([
                'id_pemesanan' => $request->id_pemesanan,
                'tipe_pembayaran' => $request->tipe_pembayaran,
                'upload_bukti_transfer' => $nama_file,
             ]);
            return redirect('/pembayaran')->with('update','berhasil');
        }
        else{
            DB::table('pembayaran')->where('id_pemesanan',$request->id)->update([
                'id_pemesanan' => $request->id_pemesanan,
                'tipe_pembayaran' => $request->tipe_pembayaran,
             ]);
            return redirect('/pembayaran')->with('update','berhasil');
        }
    }

    public function delete_pembayaran($id){
        DB::table('pembayaran')->where('id_pembayaran',$id)->delete();
        return redirect('/pembayaran')->with('delete','Data Berhasil Di
        Hapus');
    }
}
