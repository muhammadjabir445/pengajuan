<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/me','AuthJWT\AuthController@me');
Route::post('/register', 'AuthJWT\AuthController@register');
Route::post('/login', 'AuthJWT\AuthController@login');
Route::post('/logout', 'AuthJWT\AuthController@logout');
Route::post('/edit-profile','AuthJWT\AuthController@EditProfile');
Route::get('/setting-color','Setting\SettingController@color');

Route::resource('inventori', 'Inventori\InventoriController');
Route::middleware(['auth:api'])->group(function () {
Route::get('/role-management','Role\RoleManagementController@index');
Route::post('/role-management','Role\RoleManagementController@store');
Route::get('/role-management/{id}/edit','Role\RoleManagementController@edit');
Route::post('pengajuan/{id}/status', 'Pengajuan\PengajuanController@changeStatus');
Route::post('pengajuan/{id}/saran', 'Pengajuan\PengajuanController@saran');

Route::get('/report-pengajuan/{id}/excel','Report\ReportController@pengajuan_excel');
Route::get('/report-pengajuan/{id}/pdf','Report\ReportController@pengajuan_pdf');

Route::get('/report-pembelian/{id}/excel','Report\ReportController@pembelian_excel');
Route::get('/report-pembelian/{id}/pdf','Report\ReportController@pembelian_pdf');
Route::get('/pembelian', 'Pembelian\PembelianController@index');
Route::get('/pembelian/{id}/detail', 'Pembelian\PembelianController@show');
Route::get('/pembelian/{id}/edit','Pembelian\PembelianController@edit');
Route::post('/pembelian/{id}/edit','Pembelian\PembelianController@update');

Route::resource('masterdata', 'Masterdata\MasterdataController');
Route::resource('menu', 'Menu\MenuController');
Route::resource('users', 'Users\UsersController');
Route::resource('barang', 'Barang\BarangController');
Route::resource('pengajuan', 'Pengajuan\PengajuanController');



Route::resource('pengajuan-parent', 'Pengajuan\ParentPengajuanController');
Route::resource('lantai', 'Lantai\LantaiController');

});

