<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pengajuan\PengajuanCollection;
use App\Models\ParentPengajuan;
use App\Services\ReportPembelianService;
use App\Services\ReportPengajuanService;

class ReportController extends Controller
{
    public function pengajuan_excel($id){
        $data = ReportPengajuanService::data($id);
        return ReportPengajuanService::report_excel($data);
    }

    public function pengajuan_pdf($id) {
        $data = ReportPengajuanService::data($id);
        return ReportPengajuanService::report_pdf($data);
    }

    public function  pembelian_excel($id) {
        $DATA = ReportPembelianService::data($id);
        return ReportPembelianService::report_excel($DATA);
    }
    public function  pembelian_pdf($id) {
        $DATA = ReportPembelianService::data($id);
        return ReportPembelianService::report_pdf($DATA);
    }

}
