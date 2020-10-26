<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model
{
    use SoftDeletes;
    public function user(){
        return $this->belongsTo('App\User','created_by');
    }
    public function barang(){
        return $this->belongsTo('App\Models\Barang','id_barang');
    }

    public function divisi() {
        return $this->belongsTo('App\Models\MasterDataDetail','id_divisi');
    }

    public function scopeSearch($query,$request)
    {
        return $query->whereHas('barang', function($q) use($request) {
            $q->where('nama','LIKE',"%$request->keyword%");
        })->orWhereHas('user',function($q) use($request) {
            $q->where('name','LIKE',"%$request->keyword%");
        });
    }

    public function scopeWithjoin($query){
        return $query->with([
            'user' => function($q) {
                return $q->select('id','name');
            },
            'barang.satuan_barang'
        ]);
    }

    public function scopeAuth($query) {
        $auth = \Auth::user();
        if ($auth->id_role == 36) {
            return $query->where('status_pengajuan',1)->orWhere('status_pengajuan',3)->orWhere('status_pengajuan',4);
        } else if($auth->id_role != 23 && $auth->id_role != 37 && $auth->id_role != 42 ){
            return $query->where('id_divisi',$auth->id_role);
        }
    }
}
