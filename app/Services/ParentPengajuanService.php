<?php
namespace App\Services;

use App\Helpers\GlobalFunction;
use App\Models\Barang;
use App\Models\MasterDataDetail;
use App\Models\ParentPengajuan;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Pengajuan;
use DB;

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

        try {
            DB::beginTransaction();
            $error = 0;
            $pengajuan = ParentPengajuan::findOrFail($id);
            $pengajuan->status = $status;
            $deskripsi = "Pengajuan barang dengan nomor surat <b>$pengajuan->nomor_surat</b> ";
            $url = '/pengajuan-parent';

            if ($status == 3) {
                $detailPengajuan = Pengajuan::where('id_parent',$pengajuan->id)->where('status_pengajuan',3)->get();
                NotifikasiService::store($deskripsi . "telah dikonfirmasi finance",$url,$pengajuan->divisi);
                NotifikasiService::store($deskripsi . "telah dikonfirmasi finance",$url,37);
                if (count($detailPengajuan) > 0) {
                    $pembelian = new Pembelian;
                    $pembelian->nomor_surat = str_replace('PPB','SPB',$pengajuan->nomor_surat);
                    $pembelian->id_pengajuan = $pengajuan->id;
                    $pembelian->save();
                    foreach ($detailPengajuan as $value) {
                    $detailPembelian = new PembelianDetail;
                    $detailPembelian->id_barang = $value->id_barang;
                    $detailPembelian->id_pengajuan = $value->id;
                    $detailPembelian->id_pembelian = $pembelian->id;
                        if(!$detailPembelian->save()){
                            $error++;
                            throw new \Exception('Gagal Menambah Detail pembelian');
                            break;
                        }
                    }
                }
            } else if($status == 2) {
                $detailPengajuan = Pengajuan::where('id_parent',$pengajuan->id)->where('status_pengajuan',1)->get();
                NotifikasiService::store($deskripsi . "telah diteruskan ke finance oleh hrd",$url,$pengajuan->divisi);
                NotifikasiService::store("Pengajuan barang baru nomor surat <b>$pengajuan->nomor_surat</b> ",$url,36);
                if (!$detailPengajuan) {
                    $pengajuan->status = 3;
                }
            } else {
                NotifikasiService::store("Pengajuan barang baru nomor surat <b>$pengajuan->nomor_surat</b> ",$url,37);
            }
            $pengajuan->save();
            if ($error === 0) {
                DB::commit();
                $message ='Berhasil Mengubah Status';
                $status = 200;
            }
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            $status = 500;
        }

        return response()->json([
            'message' => $message
        ],$status);
    }
}
