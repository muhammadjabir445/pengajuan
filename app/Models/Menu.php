<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use SoftDeletes;
    protected $table = 'menu';
    public function child_menu(){
        return $this->hasMany('App\Models\ChildMenu','id_menu');
    }
    public function scopeAuth($q) {
        $user = \Auth::user();
        if ($user->id_role !== 23) {
            $q->where('url','!=','/masterdata')->where('url','!=','/menu');
        }
    }
}
