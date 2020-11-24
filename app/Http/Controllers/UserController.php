<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function tampil_lupapassword(){
       
        return view('layouts/lupapassword');
    }

    public function getpassword(Request $request){
        $request->validate([
            'username' => 'required','email' => 'required|email']);
        $email=$request->email;
        $username=$request->username;
            $cekemail = DB::table('admin')->where('EMAIL_ADMIN',$email)->first();
            $cekusername = DB::table('admin')->where('USERNAME_ADMIN',$username)->first();
            
            if($cekemail!=null){
                if($cekusername!=null){
                   $hasil=$cekemail->PASSWORD_ADMIN;
                //    dump($hasil);
                   return redirect('/lupapassword')->with('get_pass',$hasil);
                }
                else{
                    // echo "Username Tidak Ada !";
                    return redirect('/lupapassword')->with('user_tdk_ada','a');
                }
            }
            else{
                // echo "Email Tidak Ada !";
                return redirect('/lupapassword')->with('email_tdk_ada','b');
            }
    }
}
