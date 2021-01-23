<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        
    }

  

    public function get_detail_produk($id){
        $kategori_produk = DB::table("produk")->where("ID_PRODUK",$id)->get();
        return json_encode($kategori_produk);
    }

    public function get_produk($id){
        // $produk = DB::table("produk")->where("ID_SUPPLIER",$id)->pluck("NAMA_PRODUK","ID_PRODUK");
         $produk = DB::table("produk")->where("ID_SUPPLIER",$id)->get();
        return json_encode($produk);
    }
    
    public function tambah_stok_produk(){
        $produk = DB::table('produk')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        $supplier = DB::table('supplier')->get();
        $update_stok = DB::table('update_stok')->get();
        $user = DB::table('users')->get();
        
        // dump($produk);
        return view('produk/tambah_stok_produk',['produk'=>$produk,'kategori_produk'=>$kategori_produk
        ,'supplier'=>$supplier,'update_stok'=>$update_stok,'user'=>$user]);
    }

    public function update_stok_produk(Request $request){
        // dd($request->all());
        $stok_total = $request->stok_saat_ini + $request->tambah_stok;

        try{
            DB::table('produk')->where('ID_PRODUK',$request->produk)->update([
                'STOK_PRODUK'=> $stok_total
            ]);
            
            DB::table('update_stok')->insert([
                'nama_supplier' => $request->supplier,
                'nama_produk' => $request->produk,
                'tanggal_pembelian_produk' => $request->tanggal_pembelian,
                'stok_saat_ini' => $request->stok_saat_ini,
                'stok_ditambah' => $request->tambah_stok,
                'stok_total' => $stok_total,
                'nama_user' => $request->nama_user,
                'kategori_produk' => $request->kategori_produk,
            ]);
        }
        catch(\Exception $e){
            return redirect('/tambah-stok-produk')->with('pilih_produk','berhasil');
        }

        return redirect('/tambah-stok-produk')->with('insert','berhasil');
        
    }

    public function tampil_data_produk(){
        $produk = DB::table('produk')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        $supplier = DB::table('supplier')->get();
        // dump($produk);
        return view('produk/data_produk',['produk'=>$produk,'kategori_produk'=>$kategori_produk
        ,'supplier'=>$supplier]);
    }

    public function history_produk(){
        $produk = DB::table('produk')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        $supplier = DB::table('supplier')->get();
        $user = DB::table('users')->get();
        $history_produk = DB::table('history_produk')->get();
        $history_sebelum_perubahan_produk = DB::table('history_sebelum_perubahan_produk')->get();
        // dump($produk);
        return view('produk/history_produk',['produk'=>$produk,'kategori_produk'=>$kategori_produk
        ,'supplier'=>$supplier,'history_produk'=>$history_produk,'history_sebelum_perubahan_produk'=>$history_sebelum_perubahan_produk
        ,'user'=>$user]);
      }

    public function store_produk(Request $request){
        // $this->validate($request, [
		// 	'file' => 'required|file|image|mimes:jpeg,png,jpg',
        // ]);

        // // menyimpan data file yang diupload ke variabel $file
        // $file = $request->file('file');
        
        // $nama_file = time()."_".$file->getClientOriginalName();
        
        //  // isi dengan nama folder tempat kemana file diupload
		// $tujuan_upload = 'data_file';
		// $file->move($tujuan_upload,$nama_file);
        
        if($request->hasFile('file')){
            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'foto_produk';
		    $file->move($tujuan_upload,$nama_file);
        }

        $hb = $request->harga_beli;
        $x = str_replace("Rp.","",$hb);
        $harga_beli = str_replace(".","",$x);

        $hr = $request->harga_jual_reseller;
        $y = str_replace("Rp.","",$hr);
        $harga_jual_reseller = str_replace(".","",$y);

        $hj = $request->harga_jual;
        $y = str_replace("Rp.","",$hj);
        $harga_jual = str_replace(".","",$y);

        DB::table('produk')->insert(['ID_SUPPLIER' => $request->supplier,
        'ID_KATEGORI_PRODUK' => $request->kategori,
        'NAMA_PRODUK' => $request->nama,
        'TANGGAL_PEMBELIAN_PRODUK'=> $request->daterangepicker,
        'STOK_PRODUK'=> $request->stok,
        'HARGA_BELI_PRODUK'=> $harga_beli,
        'HARGA_JUAL_RESELLER_PRODUK'=> $harga_jual_reseller,
        'HARGA_JUAL_PELANGGAN_PRODUK'=> $harga_jual,
        'DESKRIPSI_PRODUK'=> $request->deskripsi_produk,
        'FOTO_PRODUK' => $nama_file
        ]);
        return redirect('/data-produk')->with('insert','berhasil');
    }

    public function update_produk(Request $request){
        $hb = $request->harga_beli;
        $x = str_replace("Rp.","",$hb);
        $update_harga_beli = str_replace(".","",$x);

        $hr = $request->harga_jual_reseller;
        $y = str_replace("Rp.","",$hr);
        $update_harga_jual_reseller = str_replace(".","",$y);

        $hj = $request->harga_jual;
        $y = str_replace("Rp.","",$hj);
        $update_harga_jual = str_replace(".","",$y);

        
        $produk=DB::table('produk')->where('ID_PRODUK',$request->id)->first();

       

        if($request->hasFile('file')){

             //insert ke tabel history_sebelum_perubahan_produk
                DB::table('history_sebelum_perubahan_produk')->insert(['ID_SUPPLIER' => $produk->ID_SUPPLIER,
                'ID_KATEGORI_PRODUK' => $produk->ID_KATEGORI_PRODUK,
                'NAMA_PRODUK' => $produk->NAMA_PRODUK,
                'TANGGAL_PEMBELIAN_PRODUK'=> $produk->TANGGAL_PEMBELIAN_PRODUK,
                'STOK_PRODUK'=> $produk->STOK_PRODUK,
                'HARGA_BELI_PRODUK'=> $produk->HARGA_BELI_PRODUK,
                'HARGA_JUAL_RESELLER_PRODUK'=> $produk->HARGA_JUAL_RESELLER_PRODUK,
                'HARGA_JUAL_PELANGGAN_PRODUK'=> $produk->HARGA_JUAL_PELANGGAN_PRODUK,
                'DESKRIPSI_PRODUK'=> $produk->DESKRIPSI_PRODUK,
                ]);

            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'foto_produk';
            $file->move($tujuan_upload,$nama_file);

            // echo 'masuk';

            DB::table('produk')->where('ID_PRODUK',$request->id)->update([
                'ID_SUPPLIER' => $request->supplier,
                'ID_KATEGORI_PRODUK' => $request->kategori,
                'NAMA_PRODUK' => $request->nama,
                'TANGGAL_PEMBELIAN_PRODUK'=> $request->daterangepicker,
                'STOK_PRODUK'=> $request->stok,
                'HARGA_BELI_PRODUK'=> $update_harga_beli,
                'HARGA_JUAL_RESELLER_PRODUK'=> $update_harga_jual_reseller,
                'HARGA_JUAL_PELANGGAN_PRODUK'=> $update_harga_jual,
                'DESKRIPSI_PRODUK'=> $request->deskripsi_produk,
                'FOTO_PRODUK' => $nama_file
            ]);

            DB::table('history_produk')->insert(['ID_SUPPLIER' => $request->supplier,
            'ID_KATEGORI_PRODUK' => $request->kategori,
            'NAMA_PRODUK' => $request->nama,
            'TANGGAL_PEMBELIAN_PRODUK'=> $request->daterangepicker,
            'STOK_PRODUK'=> $request->stok,
            'HARGA_BELI_PRODUK'=> $update_harga_beli,
            'HARGA_JUAL_RESELLER_PRODUK'=> $update_harga_jual_reseller,
            'HARGA_JUAL_PELANGGAN_PRODUK'=> $update_harga_jual,
            'DESKRIPSI_PRODUK'=> $request->deskripsi_produk,
            'ID_PEGAWAI' =>$request->nama_user
            ]);
            
            return redirect('/data-produk')->with('update','berhasil');
        }
        else{
            //insert ke tabel history_sebelum_perubahan_produk
            DB::table('history_sebelum_perubahan_produk')->insert(['ID_SUPPLIER' => $produk->ID_SUPPLIER,
            'ID_KATEGORI_PRODUK' => $produk->ID_KATEGORI_PRODUK,
            'NAMA_PRODUK' => $produk->NAMA_PRODUK,
            'TANGGAL_PEMBELIAN_PRODUK'=> $produk->TANGGAL_PEMBELIAN_PRODUK,
            'STOK_PRODUK'=> $produk->STOK_PRODUK,
            'HARGA_BELI_PRODUK'=> $produk->HARGA_BELI_PRODUK,
            'HARGA_JUAL_RESELLER_PRODUK'=> $produk->HARGA_JUAL_RESELLER_PRODUK,
            'HARGA_JUAL_PELANGGAN_PRODUK'=> $produk->HARGA_JUAL_PELANGGAN_PRODUK,
            'DESKRIPSI_PRODUK'=> $produk->DESKRIPSI_PRODUK,
            ]);
            
            // echo 'tdk masuk';
            DB::table('produk')->where('ID_PRODUK',$request->id)->update([
                'ID_SUPPLIER' => $request->supplier,
                'ID_KATEGORI_PRODUK' => $request->kategori,
                'NAMA_PRODUK' => $request->nama,
                'TANGGAL_PEMBELIAN_PRODUK'=> $request->daterangepicker,
                'STOK_PRODUK'=> $request->stok,
                'HARGA_BELI_PRODUK'=> $update_harga_beli,
                'HARGA_JUAL_RESELLER_PRODUK'=> $update_harga_jual_reseller,
                'HARGA_JUAL_PELANGGAN_PRODUK'=> $update_harga_jual,
                'DESKRIPSI_PRODUK'=> $request->deskripsi_produk
            ]);

            DB::table('history_produk')->insert(['ID_SUPPLIER' => $request->supplier,
            'ID_KATEGORI_PRODUK' => $request->kategori,
            'NAMA_PRODUK' => $request->nama,
            'TANGGAL_PEMBELIAN_PRODUK'=> $request->daterangepicker,
            'STOK_PRODUK'=> $request->stok,
            'HARGA_BELI_PRODUK'=> $update_harga_beli,
            'HARGA_JUAL_RESELLER_PRODUK'=> $update_harga_jual_reseller,
            'HARGA_JUAL_PELANGGAN_PRODUK'=> $update_harga_jual,
            'DESKRIPSI_PRODUK'=> $request->deskripsi_produk,
            'ID_PEGAWAI' =>$request->nama_user
            ]);

            return redirect('/data-produk')->with('update','berhasil');
        }

       
    }

    public function delete_produk($id)
    {
        DB::table('produk')->where('ID_PRODUK',$id)->delete();
        return redirect('/data-produk')->with('delete','Data Berhasil Di
        Hapus');
    }

    public function tampil_kategori_produk(){
        $produk = DB::table('produk')->get();
        $kategori_produk = DB::table('kategori_produk')->get();
        return view('produk/kategori_produk',['kategori_produk'=>$kategori_produk,'produk'=>$produk]);
    }

    public function store_kategori_produk(Request $request){
        DB::table('kategori_produk')->insert(['NAMA_KATEGORI_PRODUK' => $request->kategori_produk
        ]);
        return redirect('/kategori-produk')->with('insert','berhasil');
    }

    public function update_kategori_produk(Request $request){
        DB::table('kategori_produk')->where('ID_KATEGORI_PRODUK',$request->id)->update([
            'NAMA_KATEGORI_PRODUK' => $request->kategori_produk
        ]);
        return redirect('/kategori-produk')->with('update','berhasil');
    }

    public function delete_kategori_produk($id){
        DB::table('kategori_produk')->where('ID_KATEGORI_PRODUK',$id)->delete();
        return redirect('/kategori-produk')->with('delete','Data Berhasil Di
        Hapus');
    }
}
