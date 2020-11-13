<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;
    public function satuan_barang(){
        return $this->belongsTo('App\Models\MasterDataDetail','satuan');
    }

    public function inventori(){
        return $this->hasMany('App\Models\Inventori','id_barang');
    }
    //
}
