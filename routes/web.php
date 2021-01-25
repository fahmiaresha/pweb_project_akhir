<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/login',['as'=>'login', 'uses' => 'Auth\LoginController@showLoginForm']);
// Route::post('/login', ['uses'=>'Auth\LoginController@login']);
// Route::get('/logout',['as'=>'logout', 'uses'=>'Auth\LoginController@logout']);
// Route::get('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegisterForm']);
// Route::post('password/email', ['as'=>'password.email', 'uses'=>'Auth\ForgotPasswordController@sendResetLinkEmail']);
// Route::get('password/reset', ['as'=>'password.request', 'uses'=>'Auth\ForgotPasswordController@showLinkRequestForm']);
// Route::post('password/reset', ['as'=>'password.request', 'uses'=>'Auth\ResetPasswordController@reset']);
// Route::get('password/reset/{token}', ['as'=>'password.reset', 'uses'=>'Auth\ResetPasswordController@showResetForm']);
// Route::post('logout', ['as'=>'logout', 'uses'=>'Auth\LoginController@logout']);
// Authentication Routes...

// $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
// $this->post('login', 'Auth\LoginController@login');
// $this->post('logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes...
// $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// $this->post('register', 'Auth\RegisterController@register');

// // Password Reset Routes...
// $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// $this->post('password/reset', 'Auth\ResetPasswordController@reset');


// Route::get('/', 'HomeController@index')->name('home');
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/lupapassword', 'UserController@tampil_lupapassword');

//dashboard

Route::get('/',['as'=>'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Auth::routes();

// Route::get('/', 'ShowController@tampil_dashboard');
// Route::get('/dashboard', 'ShowController@tampil_dashboard')->name('dashboard');


//hak akses owner
Route::group(['middleware' => ['auth','cekuser:1','cekstatusakun:1']], function(){

//laporan-penjualan
Route::get('/laporan-penjualan', 'LaporanController@laporan_penjualan')->name('laporan-penjualan');
Route::post('/search-laporan-penjualan', 'LaporanController@search_laporan_penjualan');
Route::get('/pdf-laporan-penjualan/{fromdate}/{todate}/{input_produk}', 'LaporanController@pdf_penjualan');

//laporan-nota-supplier
Route::get('/laporan-nota-supplier', 'LaporanController@laporan_nota_supplier')->name('laporan-nota-supplier');
Route::post('/search-nota-supplier', 'LaporanController@search_nota_supplier');
Route::get('/pdf-nota-supplier/{fromdate}/{todate}/{input_supplier}', 'LaporanController@pdf_nota_supplier');

//pegawai
Route::get('/pegawai', 'PegawaiController@data_pegawai')->name('pegawai');
Route::post('/store-pegawai', 'PegawaiController@store_pegawai');
Route::post('/update-status-pegawai', 'PegawaiController@update_status_pegawai');
Route::post('/update-pegawai', 'PegawaiController@update_pegawai');
Route::get('/delete-pegawai/{id}', 'PegawaiController@delete_pegawai');
Route::post('/update-password-pegawai', 'PegawaiController@update_password_pegawai');

//nota-supplier
Route::get('/nota-supplier', 'SupplierController@tampil_nota_supplier')->name('nota-supplier');
Route::post('/nota-supplier-store', 'SupplierController@store_nota_supplier');
Route::post('/nota-supplier-update', 'SupplierController@update_nota_supplier');
Route::post('/update-status-nota-supplier', 'SupplierController@status_nota_supplier');

});

//hak akses admin
Route::group(['middleware' => ['auth','cekuser:1,2','cekstatusakun:1']], function(){

Route::get('/home', 'ShowController@tampil_dashboard')->name('home');
Route::get('/logout',['as'=>'logout', 'uses'=>'Auth\LoginController@logout']);

//pelanggan
Route::get('/data-pelanggan', 'PelangganController@tampil_pelanggan')->name('data-pelanggan');
Route::post('/data-pelanggan-store', 'PelangganController@store_pelanggan');
Route::post('/data-pelanggan-update', 'PelangganController@update_pelanggan');
Route::get('/data-pelanggan-delete/{id}','PelangganController@delete_pelanggan');

//kategori-pelanggan
Route::get('/kategori-pelanggan', 'PelangganController@tampil_kategori_pelanggan')->name('kategori-pelanggan');
Route::post('/data-kategori-pelanggan-store', 'PelangganController@store_kategori_pelanggan');
Route::post('/data-kategori-pelanggan-update', 'PelangganController@update_kategori_pelanggan');
Route::get('/data-kategori-pelanggan-delete/{id}', 'PelangganController@delete_kategori_pelanggan');

//service-pelanggan
Route::get('/service-pelanggan', 'PelangganController@tampil_service_pelanggan')->name('service-pelanggan');
Route::post('/data-service-pelanggan-store', 'PelangganController@store_service_pelanggan');
Route::post('/data-service-pelanggan-update', 'PelangganController@update_service_pelanggan');
Route::get('/data-service-pelanggan-print/{id}', 'PelangganController@print_service_pelanggan')->name('nota-service-pelanggan');
Route::post('/update-status-service-pelanggan', 'PelangganController@status_service_pelanggan');

//pre-order-pelanggan
Route::get('/pesanan-pelanggan', 'PelangganController@tampil_pesanan_pelanggan')->name('pesanan-pelanggan');
Route::post('/pesanan-pelanggan-store', 'PelangganController@store_pesanan_pelanggan');
Route::post('/pesanan-pelanggan-update', 'PelangganController@update_pesanan_pelanggan');
Route::post('/update-status-pesan-pelanggan', 'PelangganController@status_pesan_pelanggan');
Route::post('/pesanan-pelanggan-send-wa', 'PelangganController@send_wa_pesanan_pelanggan');

//supplier
Route::get('/data-supplier', 'SupplierController@tampil_supplier')->name('data-supplier');
Route::post('/data-supplier-store', 'SupplierController@store_supplier');
Route::post('/data-supplier-update', 'SupplierController@update_supplier');
Route::get('/data-supplier-delete/{id}', 'SupplierController@delete_supplier');


//pesan-supplier
Route::get('/pesan-supplier', 'SupplierController@tampil_pesan_supplier')->name('pesan-supplier');
Route::post('/pesan-supplier-store', 'SupplierController@store_pesan_supplier');
Route::post('/pesan-supplier-update', 'SupplierController@update_pesan_supplier');
Route::post('/data-supplier-send-wa', 'SupplierController@send_wa_pesan_supplier');
Route::post('/update-status-pesan-supplier', 'SupplierController@status_pesan_supplier');



//produk
Route::get('/data-produk', 'ProdukController@tampil_data_produk')->name('data-produk');
Route::post('/data-produk-store', 'ProdukController@store_produk');
Route::post('/data-produk-update', 'ProdukController@update_produk');
Route::get('/data-produk-delete/{id}', 'ProdukController@delete_produk');

//history-produk
Route::get('/history-produk', 'ProdukController@history_produk')->name('history-produk');

//kategori-produk
Route::get('/kategori-produk', 'ProdukController@tampil_kategori_produk')->name('kategori-produk');
Route::post('/kategori-produk-store', 'ProdukController@store_kategori_produk');
Route::post('/kategori-produk-update', 'ProdukController@update_kategori_produk');
Route::get('/kategori-produk-delete/{id}', 'ProdukController@delete_kategori_produk');

//tambah-stok-produk
Route::get('/get_detail_produk/{id}', 'ProdukController@get_detail_produk');
Route::get('/get_produk/{id}', 'ProdukController@get_produk');
Route::get('/tambah-stok-produk', 'ProdukController@tambah_stok_produk')->name('tambah-stok-produk');
Route::post('/update-stok-produk', 'ProdukController@update_stok_produk');

//whatsapp
Route::get('/whatsapp', 'ShowController@show_whatsapp')->name('whatsapp');
Route::post('/whatsapp-store', 'ShowController@store_whatsapp');

//settings
Route::get('/profile', 'ShowController@profile')->name('profile');
Route::post('/update-profile', 'ShowController@update_profile');
Route::post('/ubah-password-pegawai', 'ShowController@ubahpassword');


//penerimaan-barang
Route::get('/data-penerimaan-barang', 'PenerimaanController@show_penerimaan_barang')->name('data-penerimaan-barang');
Route::get('/penerimaan-barang', 'PenerimaanController@input_penerimaan_barang')->name('penerimaan-barang');
Route::post('/penerimaan-barang/store', 'PenerimaanController@store_penerimaan_barang');
Route::get('/get-supplier/{id}', 'PenerimaanController@get_supplier');

//point-of-sales
Route::get('/point-of-sales', 'PosController@show_pos')->name('point-of-sales');
Route::post('/point-of-sales/store', 'PosController@store_pos');
Route::get('/get_detail_pelanggan/{id}', 'PosController@get_detail_pelanggan');
Route::post('/store-pelanggan-ajax', 'PosController@store_pelanggan_ajax');

//penjualan
Route::get('/data-penjualan', 'PosController@show_data_penjualan')->name('data-penjualan');
Route::get('/invoice-penjualan/{id}', 'PosController@invoice_penjualan');

});

// user-manual
Route::get('user-manual', 'ShowController@user_manual')->name('user-manual');

Route::get('/404', 'ShowController@show_404');




