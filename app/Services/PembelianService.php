<?php
namespace App\Services;

use App\Models\Barang;
use App\Models\PembelianDetail;

Class PembelianService{

    public static function update($request,$id) {

        $pembelian = PembelianDetail::findOrFail($id);
        $pembelian->harga = $request->harga;
        $pembelian->input_by = \Auth::user()->id;
        $pembelian->tempat_beli = $request->tempat_beli;
        $pembelian->status = true;
        if ($request->file('foto')) {
            $file = $request->file('foto')->store('foto_pembelian','public');
            $pembelian->foto = $file;
        }

        $pembelian->save();
        return response()->json([
            'message' => 'Berhasil Input pembelian'
        ],200);

    }

}
