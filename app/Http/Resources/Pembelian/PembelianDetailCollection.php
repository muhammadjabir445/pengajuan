<?php

namespace App\Http\Resources\Pembelian;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PembelianDetailCollection extends ResourceCollection
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
