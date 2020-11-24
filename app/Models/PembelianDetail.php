<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    public function barang(){
        return $this->belongsTo('App\Models\Barang','id_barang');
    }
    public function pengajuan(){
        return $this->belongsTo('App\Models\Pengajuan','id_pengajuan');
    }

    public function inventori(){
        return $this->hasOne('App\Models\Inventori','id_pembelian');
    }

    public function scopeSearch($q,$request) {
        return $q->whereHas('barang', function($q) use($request) {
            $q->where('nama','LIKE',"%$request->keyword%");
        });
    }
}
