<?php
namespace App\Services;

use App\Notifikasi\Notifikasi;

Class NotifikasiService{
    public static function store($deskripsi,$url,$id_divisi) {
        $notifikasi = new Notifikasi();
        $notifikasi->deskripsi = $deskripsi;
        $notifikasi->url = $url;
        $notifikasi->id_divisi = $id_divisi;
        $notifikasi->save();
    }

    public static function change($id){
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->status = 1;
        $notifikasi->save();
    }

}
