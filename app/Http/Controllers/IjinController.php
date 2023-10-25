<?php

namespace App\Http\Controllers;

use App\Models\IjinModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IjinController extends Controller
{
    public function create(Request $request) {
        $validatedData = $request->validate([
            'date_from' => 'required',
            'time_from' => 'required',
            'date_to'   => 'required',
            'time_to'   => 'required',    
            'keterangan'    => 'required'
        ]);
        
        $user_id = Auth::user()->id;

        $data = [
            'date_from'     => $validatedData['date_from'],
            'time_from'     => $validatedData['time_from'],
            'date_to'       => $validatedData['date_to'],
            'time_to'       => $validatedData['time_to'],
            'keterangan'    => $validatedData['keterangan'],
            'user_id'       => $user_id
        ];

        IjinModel::create($data);

        return response()->json([
            'success'   => true,
            'data'      => $data,
            'message'   => 'Sukses untuk menambahkan Data Ijin'
        ]);
    }
}
