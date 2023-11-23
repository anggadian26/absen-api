<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportPresensiController extends Controller
{
    public function index() {
        return view('pages.presensi.reportPage');
    }
}
