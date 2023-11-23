<?php

namespace App\Http\Controllers;

use App\Models\SakiModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SakitController extends Controller
{
    public function create(Request $request) {
        $validatedData = $request->validate([
            'tanggal'   => 'required', 
        ]);

        $user_id = Auth::user()->id;

        $data = [
            'tanggal'       => $validatedData['tanggal'],
            'keterangan'    => $request->keterangan,
            'user_id'       => $user_id
        ];

        SakiModel::create($data);

        return response()->json([
            'success'   => true,
            'data'      => $data,
            'message'   => 'Sukses untuk menambahkan Data Sakit'
        ]);
    }


    public function getSakit() {
        $sakit = SakiModel::where('user_id', Auth::user()->id)->orderBy('tanggal', 'desc')->get();

        foreach($sakit as $item){
            $item->tanggal = date('d/m/Y', strtotime($item->tanggal));
        }
        
        return response()->json([
            'success'   => true,
            'data'      => $sakit,
            'message'   => 'Sukses untuk menampilkan Data Sakit'
        ]);
    }

    // WEB
    public function index(Request $request) {
        $tanggal = $request->tanggal;
        $bulanTahun = $request->bulan_tahun;
        $user_id = $request->user_id;
    
        $queri = " 
            SELECT A.*, B.name
            FROM sakit A
            INNER JOIN users B ON A.user_id = B.id
            WHERE TRUE
        ";
    
        if ($tanggal != NULL) {
            $queri .= " AND A.tanggal = '$tanggal'";
        } elseif ($bulanTahun != NULL) {
            // Extract year and month from the combined input
            list($tahun, $bulan) = explode('-', $bulanTahun);
            $queri .= " AND YEAR(A.tanggal) = $tahun AND MONTH(A.tanggal) = $bulan";
        }
    
        if ($user_id != NULL) {
            $queri .= " AND A.user_id = $user_id";
        }
    
        $queri .= " ORDER BY A.tanggal DESC ";
    
        $data = DB::select($queri);
    
        $user = User::all();
    
        return view('pages.sakit.index', compact(['data', 'user']));
    }
    
}
