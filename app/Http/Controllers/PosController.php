<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PosController extends Controller
{
    public function show_pos(){
        $penjualan = DB::table('penjualan')->get();
        $product = DB::table('produk')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $users = DB::table('users')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $id_penjualan= DB::table('penjualan')->max('ID_PENJUALAN');
        $kategori_produk = DB::table('kategori_produk')->get();
        return view('penjualan/point_of_sales',['penjualan'=>$penjualan
        ,'product'=>$product,'pelanggan'=>$pelanggan,'users'=>$users,'id_penjualan'=>$id_penjualan
        ,'kategori_pelanggan'=>$kategori_pelanggan,'kategori_produk'=>$kategori_produk]);
    }

    public function loadData(Request $request)
    {
       $product=DB::table('produk')->where('NAMA_PRODUK','like','%'.$request->key.'%')->get();
       return response()->json(['product'=>$product]);
      
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'user_id' => 'required' ,
            'nota_date' => 'required' ,
            'total_payment' => 'required|numeric'
          ]);

          try{
            DB::beginTransaction();

            DB::table('sales')->insert([
                'customer_id' => $request->customer_id ,
                'user_id' => $request->user_id ,
                'nota_date' => $request->nota_date ,
                'total_payment' => $request->total_payment 
            ]);          
    
                foreach($request['product_id'] as $pr){
                    DB::table('sales_detail')->insert([
                        'nota_id' => $request->nota_id ,
                        'product_id' => $pr ,
                        'quantity' => $request['jumlah'][$pr] ,
                        'selling_price' => $request['selling_price'][$pr] ,
                        'discount' => $request['discount'][$pr] ,
                        'total_price' => $request['total'][$pr]
                    ]);     
                }
                // $error = \Illuminate\Validation\ValidationException::withMessages([
                //     'field_name_1' => ['Validation Message #1'],
                //     'field_name_2' => ['Validation Message #2'],
                //  ]);
                // throw $error;
                DB::commit();
                return redirect('/sales_detail/create')->with('insert','data berhasil di tambah');
          }
          catch(Exception $exception){
            //   $eror = $exception;
              DB::rollBack();
              return redirect('/sales_detail/create');
            //   return redirect('/sales_detail/create',['eror'=>$eror]);
          } 
           
    }
}
