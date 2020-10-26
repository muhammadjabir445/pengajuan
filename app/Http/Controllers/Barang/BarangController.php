<?php

namespace App\Http\Controllers\Barang;

use App\Http\Controllers\Controller;
use App\Http\Resources\Barang\BarangCollection;
use App\Models\Barang;
use App\Models\MasterDataDetail;
use App\Services\BarangService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $barangs = Barang::with('satuan_barang')->where('nama','LIKE',"%{$request->keyword}%")
                    ->paginate(10);
        }else{
            $barangs = Barang::with('satuan_barang')->paginate(10);
        }

        return new BarangCollection($barangs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $satuan = MasterDataDetail::where('id_master_data',9)->get();
        return response()->json(['satuan'=>$satuan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->request->add(['slug'=>\Str::slug($request->nama,'-')]);
        $validator = \Validator::make($request->all(), [
            'nama' => 'required',
            'satuan'=> 'required',
            'slug'=>'required|unique:barangs,slug'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        return BarangService::store($request);
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
        $data = Barang::findOrFail($id);
        $satuan = MasterDataDetail::where('id_master_data',9)->get();
        return response()->json([
            'barang' => $data,
            'satuan'=>$satuan
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
        $request->request->add(['slug'=>\Str::slug($request->nama,'-')]);
        $validator = \Validator::make($request->all(), [
            'nama' => 'required',
            'satuan'=> 'required',
            'slug'=>'required|unique:barangs,slug,'.$id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        return BarangService::update($request,$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return BarangService::delete($id);
    }
}
