<?php

namespace App\Http\Resources\Pengajuan;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PengajuanCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
