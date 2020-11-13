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

use App\Models\ParentPengajuan;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
// use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
Route::get('/test',function(){

    // $user = \App\User::findOrFail(1);
    // $user->password = \Hash::make(123456);
    // $user->save();
    $data =ParentPengajuan::with(['detail'=>function($q) {
        return $q->with('barang.satuan_barang')->where('status_pengajuan',3);
    },'user'])->findOrFail(15);
    return view('report.pengajuan',compact('data'));
    $pdf = PDF::loadView('report.pengajuan');
    return $pdf->download('invoice.pdf');
});
Route::get('/{any}',function(){
    return view('index');
})->where('any', '.*');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

