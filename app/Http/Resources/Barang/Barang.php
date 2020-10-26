<?php

namespace App\Http\Resources\Barang;

use Illuminate\Http\Resources\Json\JsonResource;

class Barang extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['id' => $this->id,
                'nama' => $this->nama,
                'satuan' => $this->satuan_barang->description
                ];
    }
}
