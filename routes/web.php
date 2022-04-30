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
Route::get('/data-customer', 'ShowController@tampil_dashboard')->name('data-customer');
Route::get('/tipe-customer', 'ShowController@tampil_dashboard')->name('tipe-customer');

//waktu
Route::get('/waktu', 'ShowController@tampil_dashboard')->name('waktu');

//pemesanan
Route::get('/pemesanan', 'ShowController@tampil_dashboard')->name('pemesanan');

//pembayaran
Route::get('/pembayaran', 'ShowController@tampil_dashboard')->name('pembayaran');

//penjadwalan
Route::get('/penjadwalan', 'ShowController@tampil_dashboard')->name('penjadwalan');










