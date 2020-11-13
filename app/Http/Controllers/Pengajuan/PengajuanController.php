<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pengajuan\Pengajuan as PengajuanPengajuan;
use App\Http\Resources\Pengajuan\PengajuanCollection;
use App\Models\Barang;
use App\Models\ParentPengajuan;
use App\Models\Pengajuan;
use App\Services\PengajuanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 0 menunggu sttus hrd
    // 1 di acc hrd atau menunggu keputusan finance
    // 2 di tolak hrd
    // 3 di acc finance
    // 4 di tolak finance
    public function index(Request $request)
    {
        $parent = ParentPengajuan::findOrFail($request->id_parent);
        if(Gate::allows('akses-pengajuan',$parent->divisi)) {
            if ($request) {
                $pengajuan = Pengajuan::withjoin()
                ->where('id_parent',$request->id_parent)
                ->search($request)
                ->auth()
                ->orderBy('created_at','desc')
                ->paginate(10);
            }
            return new PengajuanCollection($pengajuan);
        } else {
            return response()->json([
                'message' => 'Unauthorize'
            ],401);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->keyword) {
            $barang = Barang::where('nama','REGEXP',"^$request->keyword")->get();
        } else {
            $barang = [];
        }

        return response()->json(['barang'=>$barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->request->add(['slug'=>\Str::slug($request->barang,'-')]);
        $validator = \Validator::make($request->all(), [
            'perkiraan_harga' => 'required',
            'total'=> 'required',
            'keterangan'=>'required',
            'tempat_pembelian'=>'required',
            'slug' => 'required|exists:barangs,slug'
        ],[
            'slug.exists' => 'Barang tidak ada'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        return PengajuanService::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pengajuan::with(['user','divisi','barang.satuan_barang'])->findOrFail($id);
        return response()->json([
            'pengajuan' => new PengajuanPengajuan($data)
        ]);
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
        $validator = \Validator::make($request->all(), [
            'perkiraan_harga' => 'required',
            'total'=> 'required',
            'keterangan'=>'required',
            'tempat_pembelian'=>'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        return PengajuanService::update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return PengajuanService::delete($id);
    }

    public function changeStatus(Request $request, $id) {
        $user = \Auth::user();
        $pengajuan ='';
        if ($request->status_pengajuan == 'true') {
            $status = $user->id_role == 37 ? 1 : 3;
        } else {
            $status = $user->id_role == 37 ? 2 : 4;
        }

        return PengajuanService::changeStatus($id,$status,$request);
    }

    public function saran(Request $request,$id) {
        return PengajuanService::saran($request,$id);
    }
}
