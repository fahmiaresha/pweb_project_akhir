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

//auth login & logout
Route::get('/',['as'=>'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::get('/logout',['as'=>'logout', 'uses'=>'Auth\LoginController@logout']);
Route::get('/home', 'ShowController@tampil_dashboard')->name('home');
Auth::routes();

//customer
Route::get('/data-customer', 'CustomerController@tampil_customer')->name('data-customer');
Route::post('/store-customer', 'CustomerController@store_customer');
Route::post('/update-customer', 'CustomerController@update_customer');
Route::get('/delete-customer/{id}', 'CustomerController@delete_customer');

//tipe-customer
Route::get('/tipe-customer', 'TipeCustomerController@tampil_tipe_customer')->name('tipe-customer');
Route::post('/store-tipe-customer', 'TipeCustomerController@store_tipe_customer');
Route::post('/update-tipe-customer', 'TipeCustomerController@update_tipe_customer');
Route::get('/delete-tipe-customer/{id}', 'TipeCustomerController@delete_tipe_customer');

//pembayaran
Route::get('/pembayaran', 'ShowController@tampil_dashboard')->name('pembayaran');

//waktu
Route::get('/waktu', 'ShowController@tampil_dashboard')->name('waktu');


//pemesanan
Route::get('/pemesanan', 'ShowController@tampil_dashboard')->name('pemesanan');


//penjadwalan
Route::get('/penjadwalan', 'ShowController@tampil_dashboard')->name('penjadwalan');










