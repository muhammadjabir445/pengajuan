<?php

namespace App\Http\Controllers\Lantai;

use App\Http\Controllers\Controller;
use App\Models\Lantai;
use App\Services\LantaiService;
use Illuminate\Http\Request;

class LantaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Lantai::with('ruangan')->where('lantai','LIKE',"%$request->keyword%")->paginate(10);
        return $data;
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
    public function validasi($request){
        $validator = \Validator::make($request->all(), [
            'lantai' => 'required',
            'ruangan' => ['required',function($attibute,$value,$fail) {
                $value = json_decode($value);
                foreach ($value as $item) {
                    if (!$item->ruangan) {
                        $fail($attibute . ' Tidak boleh ada yang kosong');
                        break;
                    }
                }
            }]
        ]);
        return $validator;
    }
    public function store(Request $request)
    {
        $validator = $this->validasi($request);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        return LantaiService::store($request);
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
        $data = Lantai::with('ruangan')->findOrFail($id);
        return response()->json([
            'lantai' => $data,
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
        $validator = $this->validasi($request);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        return LantaiService::update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return LantaiService::delete($id);
    }
}
