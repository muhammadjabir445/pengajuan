<?php

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

use App\Models\Inventori;
use App\Models\ParentPengajuan;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Pengajuan;

Route::get('/test',function(){

    $inventori = Inventori::truncate();
    $pengajuan = ParentPengajuan::truncate();
    $pembelian = Pembelian::truncate();
    $detail_pembelian = PembelianDetail::truncate();
    $pengajuan_detail = Pengajuan::truncate();

});
Route::get('/',function(){
    return redirect('/login');
})->where('any', '.*');
Route::get('/{any}',function(){
    return view('index');
})->where('any', '.*');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

