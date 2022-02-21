<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Karyawan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
<<<<<<< HEAD
        return view('layout-admin.dashboard');
=======
        $pegawai = Karyawan::with([])->get();
        $divisi  = Divisi::with([])->get();
        return view('layout-admin.dashboard.index', compact('pegawai', 'divisi'));
>>>>>>> 882927f81cf3c8d37d0772a547be63704a1462d2
    }
}
