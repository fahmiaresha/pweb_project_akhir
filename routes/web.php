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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/lupapassword', 'UserController@tampil_lupapassword');

//dashboard
Route::get('/dashboard', 'PelangganController@tampil_dashboard')->name('dashboard');

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
Route::post('/data-supplier-update', 'SupplierController@update_supplier');
Route::get('/data-supplier-delete/{id}', 'SupplierController@delete_supplier');


//pesan-supplier
Route::get('/pesan-supplier', 'SupplierController@tampil_pesan_supplier')->name('pesan-supplier');
Route::post('/pesan-supplier-store', 'SupplierController@store_pesan_supplier');
Route::post('/pesan-supplier-update', 'SupplierController@update_pesan_supplier');
Route::post('/data-supplier-send-wa', 'SupplierController@send_wa_pesan_supplier');
Route::post('/update-status-pesan-supplier', 'SupplierController@status_pesan_supplier');

//nota-supplier
Route::get('/nota-supplier', 'SupplierController@tampil_nota_supplier')->name('nota-supplier');
Route::post('/nota-supplier-store', 'SupplierController@store_nota_supplier');
Route::post('/nota-supplier-update', 'SupplierController@update_nota_supplier');
Route::post('/update-status-nota-supplier', 'SupplierController@status_nota_supplier');

//produk
Route::get('/data-produk', 'ProdukController@tampil_data_produk')->name('data-produk');
Route::post('/data-produk-store', 'ProdukController@store_produk');
Route::post('/data-produk-update', 'ProdukController@update_produk');
Route::get('/data-produk-delete/{id}', 'ProdukController@delete_produk');

//kategori-produk
Route::get('/kategori-produk', 'ProdukController@tampil_kategori_produk')->name('kategori-produk');
Route::post('/kategori-produk-store', 'ProdukController@store_kategori_produk');
Route::post('/kategori-produk-update', 'ProdukController@update_kategori_produk');
Route::get('/kategori-produk-delete/{id}', 'ProdukController@delete_kategori_produk');

//whatsapp
Route::get('whatsapp', 'ShowController@show_whatsapp')->name('whatsapp');
Route::post('whatsapp-store', 'ShowController@store_whatsapp');

// user-manual
Route::get('user-manual', 'CustomerController@user_manual')->name('user-manual');




