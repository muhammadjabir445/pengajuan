<?php

namespace App\Http\Controllers\Inventori;

use App\Http\Controllers\Controller;
use App\Http\Resources\Barang\BarangCollection;
use App\Http\Resources\Inventori\Inventori as InventoriInventori;
use App\Http\Resources\Inventori\InventoriCollection;
use App\Models\Barang;
use App\Models\Inventori;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Services\InventoriService;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Gate;

class InventoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $id_barang = Barang::select('id')->get();
        $barang = Barang::with(['satuan_barang'])->withCount('inventori')
        ->where('nama','LIKE',"%{$request->keyword}%")
        ->whereHas('inventori',function($q) use($id_barang) {
            return $q->whereIn('id_barang',$id_barang->pluck('id'));
        })
        ->orderBy('nama','ASC')
        ->paginate(10);
        return new BarangCollection($barang);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lantai = Lantai::all();
        $ruangan = Ruangan::all();

        return response()->json([
            'lantai' => $lantai,
            'ruangan' => $ruangan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['slug_barang'=>\Str::slug($request->barang,'-')]);
        $validator = \Validator::make($request->all(),[
            'slug_barang' => 'required|exists:barangs,slug',
            'id_lantai' => 'required',
            'id_ruangan' => 'required',
            'detail' => 'required',
            'foto' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        return InventoriService::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $inventori = Inventori::with(['user','barang','lantai','ruangan'])
        ->where('id_barang',$id)->search($request)
        ->paginate(10);
        return new InventoriCollection($inventori);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventori = Inventori::with(['user','barang'])->findOrFail($id);
        $lantai = Lantai::all();
        $ruangan = Ruangan::all();
        $response = Gate::inspect('view', $inventori);

        if ($response->allowed()) {
            return response()->json([
                'lantai' => $lantai,
                'ruangan' => $ruangan,
                'inventori' => new InventoriInventori($inventori)
            ]);
        } else {
            return response()->json([
                'message' => $response->message(),
            ],403);
        }

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
        $request->request->add(['slug_barang'=>\Str::slug($request->barang,'-')]);
        $validator = \Validator::make($request->all(),[
            'id_lantai' => 'required',
            'id_ruangan' => 'required',
            'detail' => 'required',
            'slug_barang' => 'required|exists:barangs,slug',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }

        return InventoriService::update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return InventoriService::delete($id);
    }
}
