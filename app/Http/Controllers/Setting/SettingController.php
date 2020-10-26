<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function color(Request $request) {
        if($request->color) {
            $data = \App\Models\Setting::findOrFail(1);
            $data->color = $request->color;
            $data->save();
        } else {
            $data = \App\Models\Setting::findOrFail(1);
        }
        return $data;
    }
}
