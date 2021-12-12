<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function findAbsensiById($id){
        return Absensi::with([])
            ->find($id);
    }

    public function index(){
        $absensi = Absensi::with(['karyawan'])
                    ->orderBy('id', 'DESC')
                    ->get();
        return view('layout-admin.absensi.index', compact('absensi'));
    }

    public function formAbsensi($id = null){
        $absensi      = $this->findAbsensiById($id);
        $karyawan     = Karyawan::all();
        return view('layout-admin.absensi.form', compact('absensi', 'karyawan'));
    }

    public function saveAbsensi(Request $request, $id = null){
        $result = [
            'status'  => false,
            'message' => ''
        ];
        try {
            $absensi = $this->findAbsensiById($id);
            if (!$absensi) {
                $absensi         = new Absensi();
            }
            $absensi->karyawan_id   = $request->karyawan_id;
            $absensi->tanggal       = $request->tgl_absen;
            $absensi->keterangan    = $request->keterangan;
            $absensi->save();

            $result['status']  = true;
            $result['message'] = 'save absensi success';
            return redirect('/admin/absensi');
        } catch (\exception $e) {
            $result['message'] = 'function saveAbsensi() fail => ' . $e->getMessage();
            return redirect()->back();
        }
    }

    public function deleteAbsensi($id){
        $absensi = $this->findAbsensiById($id);
        if (!$absensi) {
            return 'data absensi not found';
        }
        $absensi->delete();
    }
}
