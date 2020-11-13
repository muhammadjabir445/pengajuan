<?php

namespace App\Http\Resources\Pembelian;

use Illuminate\Http\Resources\Json\JsonResource;

class Pembelian extends JsonResource
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
            'nomor_surat' => $this->nomor_surat,
            'divisi' => $this->pengajuan->divisi_pengajuan->description
        ];
    }
}
