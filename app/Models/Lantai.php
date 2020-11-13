<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lantai extends Model
{
    use SoftDeletes;
    public function ruangan() {
        return $this->hasMany('App\Models\Ruangan','id_lantai');
    }
}
