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
    
    public function user_manual(){

    }

    public function show_404(){
        return view ('404');
    }

    public function profile(){
        $userId = Auth::id();

        //get-all-informasi-user
        $user = Auth::user();
        $jabatan = $user->ID_JABATAN;
        $name = $user->name;
        
        Session::put('id_user',$userId);
        Session::put('nama_user',$name);

        $pegawai = DB::table('users')->get();
        
        $jabatan = DB::table('jabatan')->get();
        return view('settings/profile',['jabatan'=>$jabatan,'pegawai'=>$pegawai]);
    }

    public function update_profile(Request $request){
        // dd($request->all());
        $request->validate([
            'nama_admin' => 'required',
            'alamat_admin' => 'required',
            'email_admin' => 'required|email',
            ]);

            DB::table('users')->where('id',$request->id)->update([
                'name' => $request->nama_admin,
                'alamat_user' => $request->alamat_admin,
                'telp_user' => $request->telp_admin,
                'email' => $request->email_admin,
            ]);

            return redirect('/profile')->with('update_profile','dd');
    }

    public function ubahpassword(Request $request){
        // dd($request->all());
        // $pw = 123456;
        // $hashed = Hash::make($pw);
        // $result = Hash::check($pw, $hashed);

        // [1] > $pw = 123456;
        // // 123456
        // [2] > $hashed = Hash::make($pw);
        // // '$2y$10$xSugoyKv765TY8DsERJ2/.mPIOwLNdM5Iw1n3x1XNVymBlHNG4cX6'
        // [3] > Hash::check($hashed, $pw);
        // // false
        // [4] > Hash::check($pw, $hashed);
        // // true

        $data = DB::table('users')->where('id',$request->id)->first();
        // $result = Hash::check($request->current_password,$data->password);
        if(Hash::check($request->current_password,$data->password)){
            // echo 'password cocok';
            if($request->password == $request->password_confirmation){
                if($request->current_password != $request->password){
                // echo 'password dan konfirmasi password cocok';
                $pw = $request->password;
                $password = Hash::make($pw);
                  DB::table('users')->where('id',$request->id)->update([
                    'password' => $password,
                  ]);
                  return redirect('/profile')->with('password_sukses_diubah','bb');
                }
                else{
                    // echo 'password lama dan baru tidak boleh sama ';
                    return redirect('/profile')->with('password_baru_lama_sama','cc');
                }
            }
            else{
                // echo 'password dan konfirmasi password tidak cocok';
                return redirect('/profile')->with('password_konfirmasipassword_tdk_cocok','dd');
            }
        }
        else{
            // echo "password tidak cocok";
            return redirect('/profile')->with('current_password_tidak_cocok','aaa');
        }
    }
  


    public function tampil_dashboard(){
        //get-id
        $userId = Auth::id();

        //get-all-informasi-user
        $user = Auth::user();
        $jabatan = $user->ID_JABATAN;
        $name = $user->name;

        Session::put('status_toast','0');
        Session::put('id_user',$userId);
        Session::put('nama_user',$name);


        $total_produk = DB::table('produk')->count();
        $total_kategori_produk = DB::table('kategori_produk')->count();
        $total_service = DB::table('service')->count();
        $total_penjualan = DB::table('penjualan')->count();
        $penjualan = DB::table('penjualan')->get();
        $produk = DB::table('produk')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $users = DB::table('users')->get();
        $kategori_pelanggan = DB::table('kategori_pelanggan')->get();
        $kategori_produk = DB::table('kategori_produk')->get();

        //laporan-tahunan
        date_default_timezone_set('Asia/Jakarta');
        $tahun_ini= date('Y');
        $bulan_tanggal_awal_tahunan="-01-01";
        $bulan_tanggal_akhir_tahunan="-12-31";

        $tgl_awal_laporan_tahunan=$tahun_ini.$bulan_tanggal_awal_tahunan;
        $tgl_akhir_laporan_tahunan=$tahun_ini.$bulan_tanggal_akhir_tahunan;

        // dump($tgl_awal_laporan_tahunan);
        // dump($tgl_akhir_laporan_tahunan);


        //laporan-bulanan
        $bulan_ini=date('m');
        $tanggal_awal_laporan_bulanan="01";
        $tanggal_akhir_laporan_bulanan="31";

        $tgl_awal_laporan_bulanan=$tahun_ini."-".$bulan_ini."-".$tanggal_awal_laporan_bulanan;
        $tgl_akhir_laporan_bulanan=$tahun_ini."-".$bulan_ini."-".$tanggal_akhir_laporan_bulanan;

        // dump($tgl_awal_laporan_bulanan);
        // dump($tgl_akhir_laporan_bulanan);

        //laporan-harian
        $tgl_awal_akhir_harian=date('Y-m-d');

        // dump($tgl_awal_akhir_harian);

        //get produk terlaris
        $produk_penjualan=DB::table('detail_penjualan')
                            ->select('ID_PRODUK',DB::raw('SUM(JUMLAH_PRODUK) AS TOTAL_PRODUK_DIJUAL'))
                            ->groupBy('ID_PRODUK')
                            ->orderBy('TOTAL_PRODUK_DIJUAL', 'DESC')
                            ->whereBetween('TANGGAL_PENJUALAN',[$tgl_awal_laporan_tahunan,$tgl_akhir_laporan_tahunan])
                            ->limit(5)->get();
        // dump($produk_penjualan);
        
        //nota supplier lunas
        $nota_supplier=nota_supplier::select(['STATUS_NOTA_SUPPLIER','NOMOR_NOTA_SUPPLIER','TANGGAL_NOTA_DATANG','ID_SUPPLIER', 'TOTAL_BAYAR_NOTA_SUPPLIER']) // Do some querying..
                    ->whereBetween('TANGGAL_NOTA_DATANG', [$tgl_awal_laporan_tahunan, $tgl_akhir_laporan_tahunan])
                    ->orderBy('STATUS_NOTA_SUPPLIER', 'ASC')
                    ->get();
        
        // dump($nota_supplier);
        
        $laporan_penjualan_perhari=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
                                ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$tgl_awal_akhir_harian, $tgl_awal_akhir_harian])
                                ->orderBy('ID_PENJUALAN', 'ASC')
                                ->get();
        // dump($laporan_penjualan_perhari);

        $laporan_penjualan_perbulan=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
                                ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$tgl_awal_laporan_bulanan, $tgl_akhir_laporan_bulanan])
                                ->orderBy('ID_PENJUALAN', 'ASC')
                                ->get();

        $laporan_penjualan_pertahun=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
                                ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$tgl_awal_laporan_tahunan, $tgl_akhir_laporan_tahunan])
                                ->orderBy('ID_PENJUALAN', 'ASC')
                                ->get();

        //laporan penjualan pertahun berdasarkan bulan yaitu bulan januari-desember
        $bulan_januari_awal=$tahun_ini."-01-01";
        $bulan_januari_akhir=$tahun_ini."-01-31";

        $bulan_februari_awal=$tahun_ini."-02-01";
        $bulan_februari_akhir=$tahun_ini."-02-31";

        $bulan_maret_awal=$tahun_ini."-03-01";
        $bulan_maret_akhir=$tahun_ini."-03-31";

        $bulan_april_awal=$tahun_ini."-04-01";
        $bulan_april_akhir=$tahun_ini."-04-31";

        $bulan_mei_awal=$tahun_ini."-05-01";
        $bulan_mei_akhir=$tahun_ini."-05-31";

        $bulan_juni_awal=$tahun_ini."-06-01";
        $bulan_juni_akhir=$tahun_ini."-06-31";

        $bulan_juli_awal=$tahun_ini."-07-01";
        $bulan_juli_akhir=$tahun_ini."-07-31";

        $bulan_agustus_awal=$tahun_ini."-08-01";
        $bulan_agustus_akhir=$tahun_ini."-08-31";

        $bulan_september_awal=$tahun_ini."-09-01";
        $bulan_september_akhir=$tahun_ini."-09-31";

        $bulan_oktober_awal=$tahun_ini."-10-01";
        $bulan_oktober_akhir=$tahun_ini."-10-31";

        $bulan_november_awal=$tahun_ini."-11-01";
        $bulan_november_akhir=$tahun_ini."-11-31";

        $bulan_desember_awal=$tahun_ini."-12-01";
        $bulan_desember_akhir=$tahun_ini."-12-31";

        // dump($bulan_januari_awal);
        // dump($bulan_januari_akhir);

        // dump($bulan_februari_awal);
        // dump($bulan_februari_akhir);

        // dump($bulan_maret_awal);
        // dump($bulan_maret_akhir);

        // dump($bulan_april_awal);
        // dump($bulan_april_akhir);

        // dump($bulan_mei_awal);
        // dump($bulan_mei_akhir);

        // dump($bulan_juni_awal);
        // dump($bulan_juni_akhir);

        // dump($bulan_juli_awal);
        // dump($bulan_juli_akhir);

        // dump($bulan_agustus_awal);
        // dump($bulan_agustus_akhir);

        // dump($bulan_september_awal);
        // dump($bulan_september_akhir);

        // dump($bulan_oktober_awal);
        // dump($bulan_oktober_akhir);

        // dump($bulan_november_awal);
        // dump($bulan_november_akhir);

        // dump($bulan_desember_awal);
        // dump($bulan_desember_akhir);

        $laporan_penjualan_januari=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_januari_awal,$bulan_januari_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();

        $laporan_penjualan_februari=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_februari_awal,$bulan_februari_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();

        $laporan_penjualan_maret=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_maret_awal,$bulan_maret_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();
        
        $laporan_penjualan_april=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_april_awal,$bulan_april_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();
        
        $laporan_penjualan_mei=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_mei_awal,$bulan_mei_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();
        
        $laporan_penjualan_juni=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_juni_awal,$bulan_juni_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();
        
        $laporan_penjualan_juli=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_juli_awal,$bulan_juli_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();

        $laporan_penjualan_agustus=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_agustus_awal,$bulan_agustus_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();
        
        $laporan_penjualan_september=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_september_awal,$bulan_september_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();

        $laporan_penjualan_oktober=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_oktober_awal,$bulan_oktober_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();
        
        $laporan_penjualan_november=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_november_awal,$bulan_november_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();
        
        $laporan_penjualan_desember=penjualan::select(['ID_PENJUALAN','TANGGAL_PENJUALAN','TOTAL_PENJUALAN','KATEGORI_PELANGGAN_PENJUALAN', 'ID_USER']) // Do some querying..
            ->whereBetween('TANGGAL_PENJUALAN_ASLI', [$bulan_desember_awal,$bulan_desember_akhir])
            ->orderBy('ID_PENJUALAN', 'ASC')
            ->get();

            // SELECT COUNT(ID_PRODUK) AS TOTAL_TERJUAL FROM detail_penjualan;

        $produk_terjual_hari = DB::table('detail_penjualan')
                                ->whereBetween('TANGGAL_PENJUALAN', [$tgl_awal_akhir_harian,$tgl_awal_akhir_harian])    
                                ->count();

        $produk_terjual_bulanan = DB::table('detail_penjualan')
                                ->whereBetween('TANGGAL_PENJUALAN', [$tgl_awal_laporan_bulanan,$tgl_akhir_laporan_bulanan])    
                                ->count();
        $produk_terjual_tahunan = DB::table('detail_penjualan')
                                ->whereBetween('TANGGAL_PENJUALAN', [$tgl_awal_laporan_tahunan,$tgl_akhir_laporan_tahunan])    
                                ->count();
        

        return view('dashboard2',['penjualan'=>$penjualan
        ,'produk'=>$produk,'pelanggan'=>$pelanggan,'users'=>$users
        ,'kategori_pelanggan'=>$kategori_pelanggan,'kategori_produk'=>$kategori_produk,'produk_penjualan'=>$produk_penjualan
        ,'total_produk'=>$total_produk,'total_kategori_produk'=>$total_kategori_produk,'total_service'=>$total_service
        ,'total_penjualan'=>$total_penjualan,'nota_supplier'=>$nota_supplier,'laporan_penjualan_perhari'=>$laporan_penjualan_perhari
        ,'laporan_penjualan_perbulan'=>$laporan_penjualan_perbulan,'laporan_penjualan_pertahun'=>$laporan_penjualan_pertahun
        ,'laporan_penjualan_januari'=>$laporan_penjualan_januari,'laporan_penjualan_februari'=>$laporan_penjualan_februari
        ,'laporan_penjualan_maret'=>$laporan_penjualan_maret,'laporan_penjualan_april'=>$laporan_penjualan_april,'laporan_penjualan_mei'=>$laporan_penjualan_mei
        ,'laporan_penjualan_juni'=>$laporan_penjualan_juni,'laporan_penjualan_juli'=>$laporan_penjualan_juli,'laporan_penjualan_agustus'=>$laporan_penjualan_agustus
        ,'laporan_penjualan_september'=>$laporan_penjualan_september,'laporan_penjualan_oktober'=>$laporan_penjualan_oktober,'laporan_penjualan_november'=>$laporan_penjualan_november
        ,'laporan_penjualan_desember'=>$laporan_penjualan_desember,'tgl_awal_laporan_tahunan'=>$tgl_awal_laporan_tahunan
        ,'tgl_akhir_laporan_tahunan'=>$tgl_akhir_laporan_tahunan,'produk_terjual_hari'=>$produk_terjual_hari,'produk_terjual_bulanan'=>$produk_terjual_bulanan
        ,'produk_terjual_tahunan'=>$produk_terjual_tahunan]);
    }

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
