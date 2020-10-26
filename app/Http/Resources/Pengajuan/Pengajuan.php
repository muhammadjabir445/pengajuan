<?php

namespace App\Http\Resources\Pengajuan;

use Illuminate\Http\Resources\Json\JsonResource;

class Pengajuan extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_barang' => $this->barang->nama,
            'total'=>$this->total,
            'satuan_barang'=> $this->barang->satuan_barang->description,
            'perkiraan_harga'=> $this->perkiraan_harga,
            'keterangan'=> $this->keterangan,
            'created_by'=> $this->user->name,
            'status_pengajuan' => $this->status_pengajuan,
            'tujuan_pengadaan' => $this->tujuan_pengadaan,
            'alasan_tolak' => $this->alasan_tolak,
            'tempat_pembelian' => $this->tempat_pembelian,
            'saran_coo' => $this->saran_coo,
        ];
    }
}
