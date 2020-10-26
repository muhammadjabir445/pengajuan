<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;
use App\Http\Resources\pengajuan\ParentPengajuan as PengajuanParentPengajuan;
use App\Http\Resources\pengajuan\ParentPengajuanCollection;
use App\Models\ParentPengajuan;
use App\Services\ParentPengajuanService;
use Illuminate\Http\Request;

class ParentPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  0 input pengajuan
    //  1 telah kirim ke hrd
    //  2 telah kirim ke finance
    // 3 telah konfirmasi finance
    public function index(Request $request)
    {
        if ($request) {
            $pengajuan = ParentPengajuan::with(['divisi_pengajuan'])
            ->filter($request)
            ->auth($request)
            ->orderBy('created_at','desc')
            ->paginate(10);
        }
        return new ParentPengajuanCollection($pengajuan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ParentPengajuanService::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengajuan = ParentPengajuan::findOrFail($id);
        return new PengajuanParentPengajuan($pengajuan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return ParentPengajuanService::changeStatus($id,$request->status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ParentPengajuanService::delete($id);
    }
}
