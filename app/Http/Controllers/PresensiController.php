<?php

namespace App\Http\Controllers;

use App\Models\PresensiModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("Asia/Jakarta");

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

    function getPresensi()
    {
        $presensi = PresensiModel::where('user_id', Auth::user()->id)->orderBy('tanggal', 'desc')->get();

        foreach ($presensi as $item) {
            if ($item->tanggal == date('Y-m-d')) {
                $item->is_hari_ini = true;
            } else {
                $item->is_hari_ini = false;
            }

            $datetime = Carbon::parse($item->tanggal)->locale('id');
            $masuk = Carbon::parse($item->masuk)->locale('id');

            // Cek apakah pulang null atau tidak
            if ($item->pulang !== null) {
                $pulang = Carbon::parse($item->pulang)->locale('id');
                $pulang->settings(['formatFunction' => 'translatedFormat']);
                $item->pulang = $pulang->format('H:i');
            } else {
                // Jika pulang null, set nilai pulang menjadi null
                $item->pulang = null;
            }

            $datetime->settings(['formatFunction' => 'translatedFormat']);
            $masuk->settings(['formatFunction' => 'translatedFormat']);
            $item->tanggal = $datetime->format('l, j F Y');
            $item->masuk = $masuk->format('H:i');

            // Tambahkan properti tanggal_real dengan nilai $item->tanggal ke dalam objek
            $item->tanggal_real = $datetime->format('Y-m-d');
        }

        return response()->json([
            'success' => true,
            'data' => $presensi,
            'message' => 'Sukses menampilkan data'
        ]);
    }


    public function getPresensiHome()
    {
        // $presensi = PresensiModel::where('user_id', Auth::user()->id)->orderBy('tanggal', 'desc')->get();
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        $presensi = PresensiModel::where('user_id', Auth::user()->id)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->get();

        foreach ($presensi as $item) {
            if ($item->tanggal == date('Y-m-d')) {
                $item->is_hari_ini = true;
            } else {
                $item->is_hari_ini = false;
            }

            $datetime = Carbon::parse($item->tanggal)->locale('id');
            $masuk = Carbon::parse($item->masuk)->locale('id');

            // Cek apakah pulang null atau tidak
            if ($item->pulang !== null) {
                $pulang = Carbon::parse($item->pulang)->locale('id');
                $pulang->settings(['formatFunction' => 'translatedFormat']);
                $item->pulang = $pulang->format('H:i');
            } else {
                // Jika pulang null, set nilai pulang menjadi null
                $item->pulang = null;
            }

            $datetime->settings(['formatFunction' => 'translatedFormat']);
            $masuk->settings(['formatFunction' => 'translatedFormat']);
            $item->tanggal = $datetime->format('l, j F Y');
            $item->masuk = $masuk->format('H:i');

            $item->tanggal_real = $datetime->format('Y-m-d');
        }

        return response()->json([
            'success' => true,
            'data' => $presensi,
            'message' => 'Sukses menampilkan data'
        ]);
    }

    // WEB
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $bulanTahun = $request->bulan_tahun;
        $tanggal = $request->tanggal;

        $query = "
            SELECT A.*, B.name
            FROM presensi A
            INNER JOIN users B ON A.user_id = B.id
            WHERE TRUE
        ";

        if ($user_id != NULL) {
            $query .= " AND A.user_id = $user_id";
        }

        if ($tanggal != NULL) {
            $query .= " AND A.tanggal = '$tanggal'";
        } else if ($bulanTahun != NULL) {
            list($tahun, $bulan) = explode('-', $bulanTahun);
            $query .= " AND YEAR(A.tanggal) = $tahun AND MONTH(A.tanggal) = $bulan";
        }
        $query .= " ORDER BY A.tanggal DESC";

        $presensi = DB::select($query);

        $user = User::all();
        foreach ($presensi as $item) {
            if ($item->tanggal == date('Y-m-d')) {
                $item->is_hari_ini = true;
            } else {
                $item->is_hari_ini = false;
            }

            $datetime = Carbon::parse($item->tanggal)->locale('id');
            $masuk = Carbon::parse($item->masuk)->locale('id');

            // Cek apakah pulang null atau tidak
            if ($item->pulang !== null) {
                $pulang = Carbon::parse($item->pulang)->locale('id');
                $pulang->settings(['formatFunction' => 'translatedFormat']);
                $item->pulang = $pulang->format('H:i');
            } else {
                // Jika pulang null, set nilai pulang menjadi null
                $item->pulang = null;
            }

            $datetime->settings(['formatFunction' => 'translatedFormat']);
            $masuk->settings(['formatFunction' => 'translatedFormat']);
            $item->tanggal = $datetime->format('l, j F Y');
            $item->masuk = $masuk->format('H:i');
        }

        return view('pages.presensi.index', compact(['presensi', 'user']));
    }
}
