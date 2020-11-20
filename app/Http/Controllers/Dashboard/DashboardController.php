<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Inventori;
use App\Models\MasterDataDetail;
use App\Models\PembelianDetail;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $total_divisi = MasterDataDetail::select(\DB::raw('count(id) as total_divisi'))->where('id_master_data',5)->where('id','!=',23)->first();
        $total_inventori = Inventori::select(\DB::raw('count(id) as total_inventori'))->first();
        $total_pengajuan = Pengajuan::select(\DB::raw('count(id) as total_pengajuan'))->first();
        $total_pembelian = PembelianDetail::select(\DB::raw('count(id) as total_pembelian'))->first();
        $chart_pengajuan = Pengajuan::join('master_data_detail','master_data_detail.id','=','pengajuans.id_divisi')
        ->select('master_data_detail.description as divisi',\DB::raw('count(pengajuans.id) as total_pengajuan'))
        ->where('pengajuans.id_divisi','<>',23)
        ->groupBy('divisi')
        ->get();

        return response()->json([
            'total_divisi' => $total_divisi->total_divisi,
            'total_inventori' => $total_inventori->total_inventori,
            'total_pengajuan' => $total_pengajuan->total_pengajuan,
            'total_pembelian' => $total_pembelian->total_pembelian,
            'chart_pengajuan' => $chart_pengajuan
        ]);

    }
}
