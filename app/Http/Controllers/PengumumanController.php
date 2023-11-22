<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
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

    // WEB
    public function index() {
        $query = "
            SELECT *
            FROM pengumuman
        ";

        $data = DB::select($query);
        return view('pages.pengumuman.index', compact(['data']));
    }

    public function add_view() {
        return view('pages.pengumuman.add');
    }

    public function delete_pengumuman($id) {
        DB::table('pengumuman')->where('id', '=', $id)->delete();
        return redirect('/pengumuman');
    }

    public function add_data(Request $request) {
        $data = [
            'judul' => $request->judul,
            'konten'    => $request->konten,
            'tanggal_upload'    => $request->tanggal_upload,
            'tanggal_delete'    => $request->tanggal_delete
        ];

        PengumumanModel::create($data);
        return redirect('/pengumuman');
    }

    public function search(Request $request){

        if($request->has('search')){

            $data = PengumumanModel::where('nama','LIKE','%' .$request->search.'%')->paginate(5);

        }else{
            $data = PengumumanModel::paginate(5);
        }
    }
}
