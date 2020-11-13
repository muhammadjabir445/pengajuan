<?php
namespace App\Services;

use App\Models\Barang;
use App\Models\Inventori;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class InventoriService{
    public static function store($request) {
        $barang = Barang::where('slug',$request->slug_barang)->first();


        $data = new Inventori();
        $data->id_barang = $barang->id;
        $data->detail = $request->detail;
        $data->id_ruangan = $request->id_ruangan;
        $data->id_lantai = $request->id_lantai;
        if ($request->user) {
            $user = User::where('name',$request->user)->first();
            $data->id_user = $request->user ? $user->id : \Auth::user()->id;
        }

        $data->kode = Str::random(10);
        $file = $request->file('foto')->store('file_inventori','public');
        $data->foto = $file;
        $data->save();
        return response()->json([
            'message' => 'Berhasil Tambah Inventori'
        ]);
    }

    public static function update($request,$id) {
        $data = Inventori::findOrFail($id);
        $response = Gate::inspect('update', $data);

        if ($response->allowed()) {
            $barang = Barang::where('slug',$request->slug_barang)->first();
            $data->detail = $request->detail;
            $data->id_barang = $barang->id;

            $data->id_ruangan = $request->id_ruangan;
            $data->id_lantai = $request->id_lantai;
            if ($request->user) {
                $user = User::where('name',$request->user)->first();
                $data->id_user = $request->user ? $user->id : \Auth::user()->id;
            }
            $data->id_user = $request->id_user ? $request->id_user : $data->id_user;
            if ($request->file('foto')) {
                $file = $request->file('foto')->store('file_inventori','public');
                $data->foto = $file;
            }

            $data->status = $request->status ? $request->status : $data->status;

            $data->save();
            return response()->json([
                'message' => 'Berhasil Edit Inventori'
            ]);
        } else {
            return response()->json([
                'message' => $response->message(),
            ],403);
        }

    }

    public static function delete($id){
        $inventori = Inventori::findOrFail($id);
        $response = Gate::inspect('delete', $inventori);

        if ($response->allowed()) {
            $inventori->delete();
            return response()->json([
            'message' => 'Berhasil Hapus Inventori'
            ]);
        } else {
            return response()->json([
                'message' => $response->message(),
            ],403);
        }

    }
}
