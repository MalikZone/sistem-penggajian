<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Karyawan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $pegawai = Karyawan::with([])->get();
        $divisi  = Divisi::with([])->get();
        return view('layout-admin.dashboard.index', compact('pegawai', 'divisi'));
    }
}
