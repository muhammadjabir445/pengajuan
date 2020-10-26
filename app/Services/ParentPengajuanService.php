<?php
namespace App\Services;

use App\Helpers\GlobalFunction;
use App\Models\Barang;
use App\Models\MasterDataDetail;
use App\Models\ParentPengajuan;
use App\Models\Pengajuan;

Class ParentPengajuanService{
    public static function store($request) {
        $pengajuan = new ParentPengajuan;
        $user = \Auth::user();
        $pengajuan->nomor_surat = GlobalFunction::set_nomor($user,$request->tanggal_pengajuan);
        $pengajuan->tanggal_pengajuan = $request->tanggal_pengajuan;
        $pengajuan->created_by = $user->id;
        $pengajuan->divisi = $user->id_role;

        if($pengajuan->save()){
            return response()->json([
                'message' => 'Berhasil Tambah Pengajuan'
            ],200);
        };

    }

    public static function update($request,$id) {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->perkiraan_harga = $request->perkiraan_harga;
        $pengajuan->total = $request->total;
        $pengajuan->keterangan = $request->keterangan;
        $pengajuan->tanggal_pengajuan = $request->tanggal_pengajuan;
        $pengajuan->tujuan_pengadaan = $request->tujuan_pengadaan;
        if($pengajuan->save()){
            return response()->json([
                'message' => 'Berhasil Edit Pengajuan'
            ],200);
        };
    }

    public static function delete($id) {
        $pengajuan = ParentPengajuan::findOrFail($id);
        $pengajuan->detail()->delete();
        $pengajuan->delete();
        return response()->json([
            'message' => 'Berhasil Hapus pengajuan'
        ],200);
    }

    public static function changeStatus($id,$status) {
        $pengajuan = ParentPengajuan::findOrFail($id);
        $pengajuan->status = $status;
        $pengajuan->save();
        return response()->json([
            'message' => 'Berhasil Mengubah Status'
        ],200);
    }
}
