<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
use App\Models\RiwayatPengumumanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("Asia/Jakarta");

class PengumumanController extends Controller
{
    function getPengumuman()
    {
        $tanggalHariIni = now()->toDateString();

        $deletedPengumuman = DB::table('pengumuman')->where('tanggal_delete', '<=', $tanggalHariIni)->first();

        if ($deletedPengumuman) {
            DB::table('riwayat_pengumuman')->insert([
                'id' => $deletedPengumuman->id,
                'judul' => $deletedPengumuman->judul,
                'konten' => $deletedPengumuman->konten,
                'tanggal_upload' => $deletedPengumuman->tanggal_upload,
                'tanggal_delete' => $deletedPengumuman->tanggal_delete,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // ...
        }

        DB::table('pengumuman')
            ->where('tanggal_delete', '<=', $tanggalHariIni)
            ->delete();

        $query = "
            SELECT *
            FROM pengumuman
        ";

        $pengumuman = DB::select($query);

        foreach ($pengumuman as $item) {
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
    public function index(Request $request)
    {
        $judul = $request->judul;
        $tanggal_upload = $request->tanggal_upload;

        $query = PengumumanModel::query()
            ->select('*')
            ->from('pengumuman')
            ->when($judul, function ($query, $judul) {
                return $query->where('judul', 'like', '%' . $judul . '%');
            })
            ->when($tanggal_upload, function ($query, $tanggal_upload) {
                return $query->where('tanggal_upload', $tanggal_upload);
            })
            ->orderBy('tanggal_upload', 'DESC');
        $data = $query->get();

        $tanggalHariIni = now()->toDateString();

        $deletedPengumuman = DB::table('pengumuman')->where('tanggal_delete', '<=', $tanggalHariIni)->first();

        if ($deletedPengumuman) {
            DB::table('riwayat_pengumuman')->insert([
                'id' => $deletedPengumuman->id,
                'judul' => $deletedPengumuman->judul,
                'konten' => $deletedPengumuman->konten,
                'tanggal_upload' => $deletedPengumuman->tanggal_upload,
                'tanggal_delete' => $deletedPengumuman->tanggal_delete,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // ...
        }

        // Hapus data yang telah dipindahkan ke riwayat_pengumuman dari table pengumuman
        DB::table('pengumuman')
            ->where('tanggal_delete', '<=', $tanggalHariIni)
            ->delete();

        return view('pages.pengumuman.index', compact(['data']));
    }

    public function add_view()
    {
        return view('pages.pengumuman.add');
    }

    public function delete_pengumuman($id)
    {
        // DB::table('pengumuman')->where('id', '=', $id)->delete();
        // return redirect('/pengumuman');
        try {
            DB::beginTransaction();

            $deletedPengumuman = DB::table('pengumuman')->where('id', '=', $id)->first();
            DB::table('pengumuman')->where('id', '=', $id)->delete();

            DB::table('riwayat_pengumuman')->insert([
                'id' => $deletedPengumuman->id,
                'judul' => $deletedPengumuman->judul,
                'konten' => $deletedPengumuman->konten,
                'tanggal_upload' => $deletedPengumuman->tanggal_upload,
                'tanggal_delete' => $deletedPengumuman->tanggal_delete,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect('/pengumuman')->with('success', 'Pengumuman berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/pengumuman')->with('error', 'Terjadi kesalahan saat menghapus pengumuman');
        }
    }

    public function add_data(Request $request)
    {
        $data = [
            'judul' => $request->judul,
            'konten'    => $request->konten,
            'tanggal_upload'    => now()->toDateString(),
            'tanggal_delete'    => $request->tanggal_delete
        ];

        PengumumanModel::create($data);
        return redirect('/pengumuman');
    }

    public function riwayatget(Request $request)
    {
        $judul = $request->judul;
        $tanggal_upload = $request->tanggal_upload;

        $query = RiwayatPengumumanModel::query()
            ->select('*')
            ->from('riwayat_pengumuman')
            ->when($judul, function ($query, $judul) {
                return $query->where('judul', 'like', '%' . $judul . '%');
            })
            ->when($tanggal_upload, function ($query, $tanggal_upload) {
                return $query->where('tanggal_upload', $tanggal_upload);
            })
            ->orderBy('tanggal_upload', 'DESC');
        $riwayat = $query->get();
        return view('pages.riwayatPengumuman.index', compact(['riwayat']));
    }
}
