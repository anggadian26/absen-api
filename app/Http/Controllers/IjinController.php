<?php

namespace App\Http\Controllers;

use App\Models\IjinModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function getIjin() {
        $ijin = IjinModel::where('user_id', Auth::user()->id)->orderBy('date_from', 'desc')->get();

        foreach ($ijin as $item) {
            $item->date_from = date('d/m/Y', strtotime($item->date_from));
            $item->date_to = date('d/m/Y', strtotime($item->date_to));
            $item->time_from = date('H:i', strtotime($item->time_from));
            $item->time_to = date('H:i', strtotime($item->time_to));
        }

        return response()->json([
            'success'   => true,
            'data'      => $ijin,
            'message'   => 'Sukses untuk menampilkan Data Ijin'
        ]);
    }

    // WEB
    public function index( Request $request ) {
        $date_from = $request->date_from;
        $flg = $request->flg;
        $user_id = $request->user_id;

        $query = "
            SELECT A.*, B.name
            FROM ijin A
            INNER JOIN users B ON A.user_id = B.id
            WHERE TRUE
        ";

        if($date_from != NULL) {
            $query .= " AND A.date_from = '$date_from'";
        }

        if($flg != NULL) {
            $query .= " AND A.flg = '$flg'";
        }

        if($user_id != NULL) {
            $query .= " AND A.user_id = $user_id";
        }

        $query .= " ORDER BY A.date_from DESC";

        $data = DB::select($query);

        $user = User::all();
        return view('pages.ijin.index', compact(['data', 'user']));
    }

    public function action($id, $flg) {
        $ijin = IjinModel::find($id);
        if($ijin) {
            IjinModel::where('id', $id)->update([
                'flg' => $flg
            ]);
            return redirect()->route('ijin');
        } else {
            return redirect()->route('ijin');
        }
    }
}
