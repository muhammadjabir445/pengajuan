<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    public function pengajuan() {
        return $this->belongsTo('App\Models\ParentPengajuan','id_pengajuan');
    }
    public function detail() {
        return $this->hasMany('App\Models\PembelianDetail','id_pembelian');
    }

    public function scopeSearch($q,$request) {
        return $q->where('nomor_surat','LIKE',"%$request->keyword%")
        ->orWhereHas('pengajuan',function($q) use($request) {
            $q->whereHas('divisi_pengajuan',function($q) use($request) {
                $q->where('description','LIKE',"%$request->keyword%");
            });
        });
    }

    public function scopeAuth($q) {
        $user = \Auth::user();
        if ($user->id_role !== 36 || $user->id_role !== 37) {
            return $q->whereHas('pengajuan',function($q) use($user) {
                $q->where('divisi',$user->id_role);
            });
        }
    }
}
