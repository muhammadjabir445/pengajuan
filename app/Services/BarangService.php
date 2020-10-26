<?php
namespace App\Services;

use App\Models\Barang;

Class BarangService{
    public static function store($request) {
        $barang = new Barang;
        $barang->nama = $request->nama;
        $barang->satuan = $request->satuan;
        $barang->slug = $request->slug;
        if($barang->save()){
            return response()->json([
                'message' => 'Berhasil Tambah Barang'
            ],200);
        };

    }

    public static function update($request,$id) {
        $barang = Barang::findOrFail($id);
        $barang->nama = $request->nama;
        $barang->satuan = $request->satuan;
        $barang->slug = $request->slug;
        if($barang->save()){
            return response()->json([
                'message' => 'Berhasil Edit Barang'
            ],200);
        };
    }

    public static function delete($id) {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return response()->json([
            'message' => 'Berhasil Hapus Barang'
        ],200);
    }
}
