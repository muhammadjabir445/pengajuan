<?php
namespace App\Services;

use App\Models\Lantai;
use App\Models\Ruangan;
use DB;
Class LantaiService{
    public static function store($request) {

        try {
            DB::beginTransaction();
            $error = 0;
            $lantai = new Lantai();
            $lantai->lantai = $request->lantai;
            if($lantai->save()) {
                $ruangan = json_decode($request->ruangan);
                foreach ($ruangan as $value) {
                    $data_ruangan = new Ruangan();
                    $data_ruangan->ruangan = $value->ruangan;
                    $data_ruangan->id_lantai = $lantai->id;
                    if($data_ruangan->save()){
                        continue;
                    } else {
                        $error++;
                        throw new \Exception('Gagal Menyimpan Ruangan');
                    }
                }
            } else {
                $error++;
                throw new \Exception('Gagal Menyimpan Lantai');

            }

            if ($error === 0) {
                DB::commit();
                $message = 'Berhasil menyimpan data';
                $status = 200;
            }

        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            $status = 500;

        }

        return response()->json([
            'message'=>$message
        ],$status);


    }

    public static function update($request,$id) {

        try {
            DB::beginTransaction();
            $error = 0;
            $lantai = Lantai::findOrFail($id);
            $lantai->lantai = $request->lantai;
            if($lantai->ruangan()->delete()) {
                if($lantai->save()) {
                    $ruangan = json_decode($request->ruangan);
                    foreach ($ruangan as $value) {
                        $data_ruangan = new Ruangan();
                        $data_ruangan->ruangan = $value->ruangan;
                        $data_ruangan->id_lantai = $lantai->id;
                        if($data_ruangan->save()){
                            continue;
                        } else {
                            $error++;
                            throw new \Exception('Gagal Menyimpan Ruangan');
                        }
                    }
                } else {
                    $error++;
                    throw new \Exception('Gagal Menyimpan Lantai');

                }
            } else {
                $error++;
                throw new \Exception('Gagal Menghaous Ruangan');
            }


            if ($error === 0) {
                DB::commit();
                $message = 'Berhasil menyimpan data';
                $status = 200;
            }

        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            $status = 500;

        }

        return response()->json([
            'message'=>$message
        ],$status);
    }

    public static function delete($id) {

        try {
            DB::beginTransaction();
            $error = 0;
            $data = Lantai::findOrFail($id);
            if ($data->ruangan()->delete()) {
                if (!$data->delete()) {
                    $error++;
                    throw new \Exception('Gagal Menghaous Lantai');
                }
            } else {
                $error++;
                throw new \Exception('Gagal Menghaous Ruangan');
            }
            if ($error === 0) {
                DB::commit();
                $message = 'Berhasil Menghapus data';
                $status = 200;
            }

        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            $status = 500;
        }

        return response()->json([
            'message'=>$message
        ],$status);
    }
}
