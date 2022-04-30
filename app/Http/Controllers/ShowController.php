<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\nota_supplier;
use App\penjualan;
use PDF;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Session;

class ShowController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    

    public function tampil_dashboard(){
        //get-id
        $userId = Auth::id();

        //get-all-informasi-user
        $user = Auth::user();
        $name = $user->name;

        Session::put('id_user',$userId);
        Session::put('nama_user',$name);

        return view('dashboard');
    }

   
}
