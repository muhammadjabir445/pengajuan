<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentPengajuan extends Model
{
    use SoftDeletes;
    protected $dates = ['tanggal_pengajuan'];

    public function detail() {
        return $this->hasMany('App\Models\Pengajuan','id_parent');
    }
    public function divisi_pengajuan() {
        return $this->belongsTo('App\Models\MasterDataDetail','divisi');
    }
    public function scopeFilter($q,$request){
        return $q->where('nomor_surat','LIKE',"%$request->keyword%")
            ->orWhereHas('divisi_pengajuan',function($q) use($request) {
               return $q->where('description','LIKE',"%$request->keyword%");
        });
    }

    public function scopeAuth($q) {
        $user = \Auth::user();
        if ($user->id_role == 36) {
            return $q->where('status',2)->orWhere('status',3);
        } else if($user->id_role == 37 || $user->id_role == 42) {
            return $q->where('status','!=',0)->orWhere('divisi',$user->id_role);
        } else {
            return $q->where('divisi',$user->id_role);
        }
    }

}
