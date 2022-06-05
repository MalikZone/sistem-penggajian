<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Http\QueryRepositories\QueryAbsensi;
use App\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{

    protected $queryAbsensi;

    public function __construct() {
        $this->queryAbsensi = new QueryAbsensi;
    }

    public function index(){
        $absensi = $this->queryAbsensi->getDataAbsensi();
        return view('layout-admin.absensi.index', compact('absensi'));
    }

    public function formAbsensi($id = null){
        $absensi      = $this->queryAbsensi->findAbsensiById($id);
        $karyawan     = Karyawan::all();
        return view('layout-admin.absensi.form', compact('absensi', 'karyawan'));
    }

    public function saveAbsensi(Request $request, $id = null){
        $result = [
            'status'  => false,
            'message' => ''
        ];
        try {
            $absensi      = $this->queryAbsensi->findAbsensiById($id);
            if (!$absensi) {
                $absensi         = new Absensi();
            }
            $absensi->karyawan_id   = $request->karyawan_id;
            $absensi->periode_from  = $request->periode_awal;
            $absensi->periode_to    = $request->periode_akhir;
            $absensi->present       = is_null($request->hadir) ? 0 : $request->hadir;
            $absensi->absen         = is_null($request->tidak_hadir) ? 0 : $request->tidak_hadir;
            $absensi->sick          = is_null($request->sakit) ? 0 : $request->sakit;
            $absensi->late          = is_null($request->terlambat) ? 0 : $request->terlambat;
            $absensi->paid_leave    = is_null($request->cuti) ? 0 : $request->cuti;
            $absensi->save();

            $result['status']  = true;
            $result['message'] = 'save absensi success';
            return redirect('/admin/absensi')->with(['success' => $result['message']]);
        } catch (\exception $e) {
            $result['message'] = 'function saveAbsensi() fail => ' . $e->getMessage();
            return redirect()->back()->with(['error' => $result['message']]);
        }
    }

    public function deleteAbsensi($id){
        $absensi      = $this->queryAbsensi->findAbsensiById($id);
        if (!$absensi) {
            return 'data absensi not found';
        }
        $absensi->delete();
    }

    // public function saveAbsensi(Request $request, $id = null){
    //     $result = [
    //         'status'  => false,
    //         'message' => ''
    //     ];
    //     try {
    //         $absensi = $this->findAbsensiById($id);
    //         if (!$absensi) {
    //             $absensi         = new Absensi();
    //             $absenOnDate     = $this->queryAbsensi->absenOnDate($request->karyawan_id, $request->tgl_absen);
    //             if ($absenOnDate) {
    //                 return redirect()->back()->with(['error' => 'anda tidak bisa melakukan absensi lebih dari sekali']);
    //             }
    //         }
    //         $absensi->karyawan_id   = $request->karyawan_id;
    //         $absensi->tanggal       = $request->tgl_absen;
    //         $absensi->keterangan    = $request->keterangan;
    //         $absensi->save();

    //         $result['status']  = true;
    //         $result['message'] = 'save absensi success';
    //         return redirect('/admin/absensi');
    //     } catch (\exception $e) {
    //         $result['message'] = 'function saveAbsensi() fail => ' . $e->getMessage();
    //         return redirect()->back();
    //     }
    // }

}
