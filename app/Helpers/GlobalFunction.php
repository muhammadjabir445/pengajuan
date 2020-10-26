<?php

namespace App\Helpers;

use App\Models\MasterDataDetail;
use App\Models\ParentPengajuan;

class GlobalFunction {
    public static function set_nomor($user,$date) {
        $pengajuan = ParentPengajuan::where('divisi',$user->id_role)->orderBy('created_at','desc')->first();
        $divisi =  MasterDataDetail::where('id',$user->id_role)->first();

        $date_format = \Carbon\Carbon::parse($date);
        $bulan = GlobalFunction::set_bulan($date_format->format('m'));
        $format_nomor = "/PPB/$divisi->description/HRD/{$bulan}/{$date_format->format('Y')}";
        if ($pengajuan) {
            $nomor = explode('/',$pengajuan->nomor_surat);
            $nomor = $nomor[0];
            $nomor = '1' . $nomor;
            $nomor = (int) $nomor;
            $nomor++;
            $nomor = (string) $nomor;
            $nomor = ltrim($nomor,'1');
            $nomor = $nomor . $format_nomor;
        } else {
            $nomor = '001' . $format_nomor;
        }
        return $nomor;
    }


    public static function set_bulan($bulan){
        switch ($bulan) {
            case '01':
                $i = 'I';
                break;
            case '02':
                $i = 'II';
                break;
            case '03':
                $i = 'III';
                break;
            case '04':
                $i = 'IV';
                break;
            case '05':
                $i = 'V';
                break;
            case '06':
                $i = 'VI';
                break;
            case '07':
                $i = 'VII';
                break;
            case '08':
                $i = 'VIII';
                break;
            case '09':
                $i = 'IX';
                break;
            case '10':
                $i = 'X';
                break;
            case '11':
                $i = 'XI';
                break;
            case '12':
                $i = 'XII';
                break;
            default:
                $i = 'I';
                break;
        }
        return $i;
    }
}
