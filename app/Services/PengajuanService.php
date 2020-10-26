<?php
namespace App\Services;

use App\Models\Barang;
use App\Models\ParentPengajuan;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Gate;

Class PengajuanService{
    public static function store($request) {
        $parent = ParentPengajuan::findOrFail($request->id_parent);
        if(Gate::allows('create-pengajuan',$parent)) {
            $id_barang = Barang::where('slug',$request->slug)->first();
            $pengajuan = new Pengajuan;
            $pengajuan->id_barang = $id_barang->id;
            $pengajuan->id_parent = $request->id_parent;
            $pengajuan->perkiraan_harga = $request->perkiraan_harga;
            $pengajuan->total = $request->total;
            $pengajuan->keterangan = $request->keterangan;
            $pengajuan->tujuan_pengadaan = $request->tujuan_pengadaan;
            $pengajuan->tempat_pembelian = $request->tempat_pembelian;

            $pengajuan->created_by = \Auth::user()->id;
            $pengajuan->id_divisi = \Auth::user()->id_role;

            if($pengajuan->save()){
                $message = 'Berhasil Tambah Pengajuan';
                $status = 200;
            };
        } else {
            $message = 'Unauthorize';
            $status = 401;
        }
        return response()->json([
            'message' => $message
        ],$status);


    }

    public static function update($request,$id) {

        $pengajuan = Pengajuan::findOrFail($id);
        if(Gate::allows('update-pengajuan',$pengajuan)) {
        $pengajuan->perkiraan_harga = $request->perkiraan_harga;
        $pengajuan->total = $request->total;
        $pengajuan->keterangan = $request->keterangan;
        $pengajuan->tujuan_pengadaan = $request->tujuan_pengadaan;
        $pengajuan->tempat_pembelian = $request->tempat_pembelian;

            if($pengajuan->save()){
                $message = 'Berhasil Edit Pengajuan';
                    $status = 200;
            }
        } else {
            $message = 'Unauthorize';
            $status = 401;
        }
        return response()->json([
            'message' => $message
        ],$status);

    }

    public static function delete($id) {
        $pengajuan = Pengajuan::findOrFail($id);
        if(Gate::allows('update-pengajuan',$pengajuan)) {
                $pengajuan->delete();

                $message = 'Berhasil Edit Pengajuan';
                    $status = 200;

        } else {
            $message = 'Unauthorize';
            $status = 401;
        }
        return response()->json([
            'message' => $message
        ],$status);

    }

    public static function changeStatus($id,$status,$request) {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status_pengajuan = $status;
        $pengajuan->alasan_tolak = $request->alasan_tolak;
        $pengajuan->save();
        return response()->json([
            'message' => 'Berhasil Mengubah status'
        ],200);
    }

    public static function saran($request,$id){
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->saran_coo = $request->saran_coo;
        $pengajuan->save();
        return response()->json([
            'message' => 'Berhasil Memberikan saran'
        ],200);
    }
}
