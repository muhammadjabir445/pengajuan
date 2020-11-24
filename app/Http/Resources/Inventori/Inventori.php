<?php

namespace App\Http\Resources\Inventori;

use Illuminate\Http\Resources\Json\JsonResource;

class Inventori extends JsonResource
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
            'id' =>$this->id,
            'barang' => $this->barang->nama,
            'lantai' => $this->lantai->lantai,
            'ruangan' => $this->ruangan->ruangan,
            'user' => $this->user->name,
            'detail' => $this->detail,
            'status' => $this->status,
            'foto'=> asset('storage/' .$this->foto)
        ];
    }
}
