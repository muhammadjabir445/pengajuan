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
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
Route::get('/test',function(){
    $patern = 'PGA20MSVE:RH0002';
    $secret = 'e9jiV2M58JUd5HKSmfJuSqYjk';
    $signature = hash_hmac('sha256',$patern,$secret);
    $response = Http::post('https://pga.growinc.dev/webapi/pay/create', [
        'merchant_code' => 'PGA20MSVE',
        'invoice_no' => 'RH0002',
        'description' => 'test',
        'amount' => 1000000,
        'customer_name' => 'test',
        'customer_email' => 'test@gmail.com',
        'customer_phone' => '08342424',
        'redirect_url' => 'http://test3/',
        'expired' => 24,
        'signature' => $signature
    ]);
    // $user = \App\User::findOrFail(1);
    // $user->password = \Hash::make(123456);
    // $user->save();
    return redirect($response);

});
Route::get('/{any}',function(){
    return view('index');
})->where('any', '.*');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

