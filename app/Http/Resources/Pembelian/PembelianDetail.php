<?php

namespace App\Http\Resources\Pembelian;

use Illuminate\Http\Resources\Json\JsonResource;

class PembelianDetail extends JsonResource
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
            'barang' => $this->barang->nama,
            'perkiraan_harga' => $this->pengajuan->perkiraan_harga,
            'total' => $this->pengajuan->total,
            'satuan_barang' =>$this->barang->satuan_barang->description,
            'harga' => $this->harga,
            'tempat_beli' => $this->tempat_beli,
            'foto' => $this->foto ? asset('storage/' . $this->foto) : ''
        ];
    }
}
