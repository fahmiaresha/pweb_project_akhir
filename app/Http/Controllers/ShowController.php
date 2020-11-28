<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;

class ShowController extends Controller
{
    public function show_whatsapp(){
        $whatsapp = DB::table('whatsapp')->get();
        return view('whatsapp',['whatsapp'=>$whatsapp]);
    }

    public function store_whatsapp(Request $request){
        $nomor2 = $request->nomor_whatsapp;
        $nomor3 = $nomor2[0];
        $nomor = str_replace($nomor3,"62",$nomor2);
        // echo $nomor;
        $pesan = $request->pesan_whatsapp;

        // $url_wa ='https://api.whatsapp.com/send?phone=+$nomor&text=$pesan&source=&data=';

        $url2="https://api.whatsapp.com/send?phone=+";
        $url3=$nomor;
        $url4="&text=";
        $url5=$pesan;
        $url6="&source=&data=";

        DB::table('whatsapp')->insert(['NO_WHATSAPP' => $nomor2,
        'PESAN_WHATSAPP' => $request->pesan_whatsapp,
        'KATEGORI_WHATSAPP' => $request->kategori
        ]);

        $url = $url2.$url3.$url4.$url5.$url6;
        return Redirect::to($url);
    }

}
