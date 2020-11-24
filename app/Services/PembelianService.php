<?php
namespace App\Services;

use App\Models\Barang;
use App\Models\Inventori;
use App\Models\PembelianDetail;

Class PembelianService{

    public static function update($request,$id) {

        try {
            \DB::beginTransaction();
            $error = 0;
            $pembelian = PembelianDetail::with('inventori')->findOrFail($id);
            $pembelian->harga = $request->harga;
            $pembelian->input_by = \Auth::user()->id;
            $pembelian->tempat_beli = $request->tempat_beli;
            $pembelian->status = true;
            if ($request->file('foto')) {
                $file = $request->file('foto')->store('foto_pembelian','public');
                $pembelian->foto = $file;
            }

                // if (!$pembelian->inventori) {
                //     $data = new Inventori();
                //     $data->id_pembelian = $pembelian->id;
                //     $data->kode = \Str::random(10);
                //     $data->id_barang = $pembelian->id_barang;
                //     $data->detail = $request->detail;
                //     $data->id_ruangan = $request->id_ruangan;
                //     $data->id_lantai = $request->id_lantai;
                //     if ($request->user) {
                //         $user = \App\User::where('name',$request->user)->first();
                //         $data->id_user = $request->user ? $user->id : \Auth::user()->id;
                //     }


                //     if ($request->file('foto_inventori')) {
                //         $file = $request->file('foto_inventori')->store('file_inventori','public');
                //         $data->foto = $file;
                //     }


                //     if(!$data->save()){
                //         throw new \Exception('Gagal Menyimpan inventori');
                //     }
                // }
            $pembelian->save();
            if ($error === 0) {
                \DB::commit();
                $message = 'Berhasil input pembelian';
                $status = 200;
            }

        } catch (\Exception $e) {
            \DB::rollback();
            $message = $e->getMessage();
            $status = 400;

        }


        return response()->json([
            'message' => $message
        ],$status);

    }

}
