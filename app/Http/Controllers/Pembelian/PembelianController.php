<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pembelian\PembelianCollection;
use App\Http\Resources\Pembelian\PembelianDetail;
use App\Http\Resources\Pembelian\PembelianDetailCollection;
use App\Services\PembelianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = \App\Models\Pembelian::with('pengajuan.divisi_pengajuan')
        ->search($request)
        ->auth()
        ->orderBy('created_at','desc')
        ->paginate(10);
        return new PembelianCollection($data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $detail = \App\Models\PembelianDetail::with(['pengajuan','barang.satuan_barang'])
        ->where('id_pembelian',$id)
        ->search($request)
        ->paginate(10);
        return new PembelianDetailCollection($detail);
    }

    public function edit($id){
        $data = \App\Models\PembelianDetail::with(['pengajuan','barang.satuan_barang'])
        ->findOrFail($id);
        return new PembelianDetail($data);
    }

    public function update(Request $request,$id) {
        if (Gate::allows('pembelian-input')) {
            return PembelianService::update($request,$id);
        } else {
            return response()->json([
                'message' => 'Tidak ada akses untuk input'
            ],400);
        }

    }

}
