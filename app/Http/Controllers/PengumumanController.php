<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
date_default_timezone_set("Asia/Jakarta");

class PengumumanController extends Controller
{
    function getPengumuman() {
        $tanggalHariIni = now()->toDateString();

        DB::table('pengumuman')
            ->where('tanggal_delete', '<=', $tanggalHariIni)
            ->delete();

        $query = "
            SELECT *
            FROM pengumuman
        ";

        $pengumuman = DB::select($query);

        foreach($pengumuman as $item) {
            $datetime = Carbon::parse($item->tanggal_upload)->locale('id');
            $datetime->settings(['formatFunction' => 'translatedFormat']);
            $item->tanggal_upload = $datetime->format('l, j F Y');
        }
        return response()->json([
            'success' => true,
            'data' => $pengumuman,
            'message' => 'Sukses menampilkan data pengumuman'
        ]);
    }
}
