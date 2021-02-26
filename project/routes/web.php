<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'HomeController@users')->name('users');
Route::get('/product', 'HomeController@product')->name('product');
Route::get('/orders', 'HomeController@orders')->name('orders');
Route::get('/laporan', 'HomeController@laporan')->name('laporan');
Route::get('/laporan/topagent', 'HomeController@laporantopagent')->name('laporantopagent');
Route::get('/laporan/topcustomer', 'HomeController@laporantopcustomer')->name('laporantopcustomer');
Route::get('/laporan/topproduct', 'HomeController@laporantopproduct')->name('laporantopproduct');
Route::get('/laporan/jualkategori', 'HomeController@laporanjualkategori')->name('laporanjualkategori');