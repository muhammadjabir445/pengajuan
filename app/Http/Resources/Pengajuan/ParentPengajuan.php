<?php

namespace App\Http\Resources\pengajuan;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentPengajuan extends JsonResource
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
            'id'=>$this->id,
            'nomor_surat'=>$this->nomor_surat,
            'divisi'=> $this->divisi_pengajuan->description,
            'tanggal_pengajuan'=>$this->tanggal_pengajuan->format('Y-m-d'),
            'status' => $this->status
        ];
    }
}
