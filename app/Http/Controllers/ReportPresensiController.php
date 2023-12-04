<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
date_default_timezone_set("Asia/Jakarta");

class ReportPresensiController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('pages.presensi.reportPage', compact(['user']));
    }

    public function downloadReport(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $user_id = $request->user_id;

        $query = "
            SELECT A.*, B.*
            FROM presensi A
            INNER JOIN users B ON A.user_id = B.id
            WHERE TRUE
        ";

        if ($date_from && $date_to) {
            $query .= " AND A.tanggal BETWEEN '$date_from' AND '$date_to'";
        } elseif ($date_from) {
            $query .= " AND A.tanggal = '$date_from'";
        } elseif ($date_to) {
            $query .= " AND A.tanggal = '$date_to'";
        }

        if ($user_id) {
            $query .= " AND A.user_id = $user_id";

            $user_query = "
                SELECT *
                FROM users
                WHERE id = $user_id
            ";

            $select = DB::select($user_query);
            $resultUser = $select[0]->name;
        } else {
            $resultUser = 'Semua';
        }

        $query .= " ORDER BY A.tanggal ASC";

        $printOn = now()->format('d/m/Y H:i:s');

        $resultPrint = $printOn . ' WIB';

        $data = DB::select($query);

        $req = (object) [
            'date_from' => $date_from ? Carbon::parse($date_from)->format('d/m/Y') : '',
            'date_to' => $date_to ? Carbon::parse($date_to)->format('d/m/Y') : '',
            'user' => $resultUser,
            'print_on' => $resultPrint
        ];

        $timestamp = now()->format('Ymd');

        $pdf = PDF::loadView('pages.presensi.downloadReport', compact('data', 'req'));
        return $pdf->download('LaporanPresensi' . $timestamp . '.pdf');
    }
}
