<?php

namespace App\Http\Controllers;

use App\Models\IjinModel;
use App\Models\PresensiModel;
use App\Models\SakiModel;
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
                'pulang' => null,
                'flg'   => 'P'
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

        $user = Auth::user();
        $yesterday = Carbon::yesterday()->toDateString();

        $presensis = PresensiModel::where('user_id', $user->id)
            ->where('tanggal', $yesterday)
            ->first();

        if (!$presensis) {
            // Jika tidak ada absensi pada tanggal kemarin, cek ijin dan sakit
            $ijin = IjinModel::where('user_id', $user->id)
                ->whereDate('date_from', '<=', $yesterday)
                ->whereDate('date_to', '>=', $yesterday)
                ->first();

            $sakit = SakiModel::where('user_id', $user->id)
                ->whereDate('tanggal', $yesterday)
                ->first();

            if ($ijin) {
                $presensis = PresensiModel::create([
                    'latitude' => null,
                    'longitude' => null,
                    'tanggal' => $yesterday,
                    'masuk' => null,
                    'pulang' => null,
                    'flg' => 'I',
                    'user_id' => $user->id,
                ]);
            } else if ($sakit) {
                $presensis = PresensiModel::create([
                    'latitude' => null,
                    'longitude' => null,
                    'tanggal' => $yesterday,
                    'masuk' => null,
                    'pulang' => null,
                    'flg' => 'S',
                    'user_id' => $user->id,
                ]);
            } else {
                $presensis = PresensiModel::create([
                    'latitude' => null,
                    'longitude' => null,
                    'tanggal' => $yesterday,
                    'masuk' => null,
                    'pulang' => null,
                    'flg' => 'N',
                    'user_id' => $user->id,
                ]);
            }
        }


        foreach ($presensi as $item) {
            if ($item->tanggal == date('Y-m-d')) {
                $item->is_hari_ini = true;
            } else {
                $item->is_hari_ini = false;
            }

            $datetime = Carbon::parse($item->tanggal)->locale('id');

            // Cek apakah masuk null atau tidak
            if ($item->masuk !== null) {
                $masuk = Carbon::parse($item->masuk)->locale('id');
                $masuk->settings(['formatFunction' => 'translatedFormat']);
                $item->masuk = $masuk->format('H:i');
            } else {
                // Jika masuk null, set nilai masuk menjadi null
                $item->masuk = null;
            }

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
            $item->tanggal = $datetime->format('l, j F Y');
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

        $user = Auth::user();
        $yesterday = Carbon::yesterday()->toDateString();

        $presensis = PresensiModel::where('user_id', $user->id)
            ->where('tanggal', $yesterday)
            ->first();

        if (!$presensis) {
            // Jika tidak ada absensi pada tanggal kemarin, cek ijin dan sakit
            $ijin = IjinModel::where('user_id', $user->id)
                ->whereDate('date_from', '<=', $yesterday)
                ->whereDate('date_to', '>=', $yesterday)
                ->first();

            $sakit = SakiModel::where('user_id', $user->id)
                ->whereDate('tanggal', $yesterday)
                ->first();

            if ($ijin) {
                $presensis = PresensiModel::create([
                    'latitude' => null,
                    'longitude' => null,
                    'tanggal' => $yesterday,
                    'masuk' => null,
                    'pulang' => null,
                    'flg' => 'I',
                    'user_id' => $user->id,
                ]);
            } else if ($sakit) {
                $presensis = PresensiModel::create([
                    'latitude' => null,
                    'longitude' => null,
                    'tanggal' => $yesterday,
                    'masuk' => null,
                    'pulang' => null,
                    'flg' => 'S',
                    'user_id' => $user->id,
                ]);
            } else {
                $presensis = PresensiModel::create([
                    'latitude' => null,
                    'longitude' => null,
                    'tanggal' => $yesterday,
                    'masuk' => null,
                    'pulang' => null,
                    'flg' => 'N',
                    'user_id' => $user->id,
                ]);
            }
        }

        foreach ($presensi as $item) {
            if ($item->tanggal == date('Y-m-d')) {
                $item->is_hari_ini = true;
            } else {
                $item->is_hari_ini = false;
            }

            $datetime = Carbon::parse($item->tanggal)->locale('id');
            // $masuk = Carbon::parse($item->masuk)->locale('id');

            // Cek apakah pulang null atau tidak
            if ($item->pulang !== null) {
                $pulang = Carbon::parse($item->pulang)->locale('id');
                $pulang->settings(['formatFunction' => 'translatedFormat']);
                $item->pulang = $pulang->format('H:i');
            } else {
                // Jika pulang null, set nilai pulang menjadi null
                $item->pulang = null;
            }

            if ($item->masuk !== null) {
                $masuk = Carbon::parse($item->masuk)->locale('id');
                $masuk->settings(['formatFunction' => 'translatedFormat']);
                $item->masuk = $masuk->format('H:i');
            } else {
                // Jika masuk null, set nilai masuk menjadi null
                $item->masuk = null;
            }

            $datetime->settings(['formatFunction' => 'translatedFormat']);
            $masuk->settings(['formatFunction' => 'translatedFormat']);
            $item->tanggal = $datetime->format('l, j F Y');
            // $item->masuk = $masuk->format('H:i');

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

        $query = PresensiModel::query()
            ->select('A.*', 'B.*')
            ->from('presensi AS A')
            ->join('users AS B', 'A.user_id', '=', 'B.id')
            ->when($user_id, function ($query, $user_id) {
                return $query->where('A.user_id', $user_id);
            })
            ->when($tanggal, function ($query, $tanggal) {
                return $query->where('A.tanggal', $tanggal);
            })
            ->when($bulanTahun, function ($query, $bulanTahun) {
                list($tahun, $bulan) = explode('-', $bulanTahun);
                return $query->whereYear('A.tanggal', $tahun)
                    ->whereMonth('A.tanggal', $bulan);
            });


        $presensi = $query->paginate(20);

        $user = User::all();
        foreach ($presensi as $item) {
            if ($item->tanggal == date('Y-m-d')) {
                $item->is_hari_ini = true;
            } else {
                $item->is_hari_ini = false;
            }

            $datetime = Carbon::parse($item->tanggal)->locale('id');
            // $masuk = Carbon::parse($item->masuk)->locale('id');

            // Cek apakah pulang null atau tidak
            if ($item->pulang !== null) {
                $pulang = Carbon::parse($item->pulang)->locale('id');
                $pulang->settings(['formatFunction' => 'translatedFormat']);
                $item->pulang = $pulang->format('H:i');
            } else {
                // Jika pulang null, set nilai pulang menjadi null
                $item->pulang = null;
            }

            if ($item->masuk !== null) {
                $masuk = Carbon::parse($item->masuk)->locale('id');
                $masuk->settings(['formatFunction' => 'translatedFormat']);
                $item->masuk = $masuk->format('H:i');
            } else {
                // Jika masuk null, set nilai masuk menjadi null
                $item->masuk = null;
            }

            $datetime->settings(['formatFunction' => 'translatedFormat']);
            $masuk->settings(['formatFunction' => 'translatedFormat']);
            $item->tanggal = $datetime->format('l, j F Y');
            // $item->masuk = $masuk->format('H:i');
        }

        return view('pages.presensi.index', compact(['presensi', 'user']));
    }
}
