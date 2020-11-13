<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventori extends Model
{
    use SoftDeletes;
    public function barang() {
        return $this->belongsTo('App\Models\Barang','id_barang');
    }

    public function lantai() {
        return $this->belongsTo('App\Models\Lantai','id_lantai');
    }

    public function user() {
        return $this->belongsTo('App\User','id_user');
    }

    public function ruangan() {
        return $this->belongsTo('App\Models\Ruangan','id_ruangan');
    }

    public function scopeSearch($q,$request) {
        return $q->whereHas('user', function($q) use($request) {
            $q->where('name','LIKE',"%$request->keyword%");
        })
        ->orWhereHas('lantai', function($q) use($request) {
            $q->where('lantai','LIKE',"%$request->keyword%");
        })
        ->orWhereHas('ruangan', function($q) use($request) {
            $q->where('ruangan','LIKE',"%$request->keyword%");
        });
    }
}
