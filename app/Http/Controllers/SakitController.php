<?php

namespace App\Http\Controllers;

use App\Models\SakiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
