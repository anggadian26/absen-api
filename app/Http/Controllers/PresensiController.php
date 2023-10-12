<?php

namespace App\Http\Controllers;

use App\Models\PresensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    function savePresensi(Request $request)
    {
        $presensi = PresensiModel::whereDate('tanggal', '=', date('Y-m-d'))
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($presensi == null) {
            $presensi = PresensiModel::create([
                'user_id' => Auth::user()->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'tanggal' => date('Y-m-d'),
                'masuk' => date('H:i:s'),
                'pulang' => null
            ]);
        } else {
            $data = [
                'pulang' => date('H:i:s')
            ];

            PresensiModel::whereDate('tanggal', '=', date('Y-m-d'))->update($data);
        }

        $presensi = PresensiModel::whereDate('tanggal', '=', date('Y-m-d'))
            ->first();

        return response()->json([
            'success' => true,
            'data' => $presensi,
            'message' => 'Sukses simpan'
        ]);
    }
}
