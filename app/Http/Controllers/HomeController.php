<?php

namespace App\Http\Controllers;
use App\Models\PresensiModel;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $presensis = PresensiModel::select('presensis.*', 'users.name')
                        ->join('users', 'presensis.user_id', '=', 'users.id')
                        ->get();
        foreach($presensis as $item) {
            $datetime = Carbon::parse($item->tanggal)->locale('id');

            $datetime->settings(['formatFunction' => 'translatedFormat']);
            
            $item->tanggal = $datetime->format('l, j F Y');
        }
        // dd($presensis);
        return view('layouts.home', [
            'presensis' => $presensis
        ]);
    }
}
