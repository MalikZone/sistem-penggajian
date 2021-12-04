<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Karyawan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function findAbsensiById($id){
        return Absensi::with([])
            ->find($id);
    }

    public function index(){
        $absensi = Absensi::with(['karyawan'])->get();
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
            $absensi->tanggal       = $request->tgl_masuk;
            $absensi->clock_in      = $request->clock_in;
            $absensi->clock_out     = $request->clock_out;
            $absensi->save();

            $result['status']  = true;
            $result['message'] = 'save absensi success';
            return redirect('/admin/absensi');
        } catch (\exception $e) {
            $result['message'] = 'function saveAbsensi() fail => ' . $e;
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
