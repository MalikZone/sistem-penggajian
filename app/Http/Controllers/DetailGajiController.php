<?php

namespace App\Http\Controllers;

use App\Http\Utilities\GenerateGajiUtility;
use App\Http\QueryRepositories\QueryAbsensi;
use App\Http\QueryRepositories\QueryDetailGaji;
use App\Karyawan;
use App\Potongan;
use Illuminate\Http\Request;
use PDF;

class DetailGajiController extends Controller
{

    protected $queryAbsensi, $detailGaji, $generateGajiUtility;

    public function __construct() {
        $this->queryAbsensi         = new QueryAbsensi;
        $this->detailGaji           = new QueryDetailGaji;
        $this->generateGajiUtility  = new GenerateGajiUtility;
    }

    public function index(Request $request){
        $filters    = $request->only([
            'periode_from','periode_to', 'name'
        ]);
        $detailGaji       = $this->detailGaji->detailGajiListByPeriode($filters);
        return view('layout-admin.detail-gaji.index', compact('detailGaji', 'filters'));
    }

    public function GenerateGaji(Request $request){
               
        $karyawan          = Karyawan::with(['divisi', 'gaji', 'absensi', 'golongan'])->get();
        $absensiPerPeriode = $this->queryAbsensi->getAbsensiPerPeriode($request->periode_form, $request->periode_to);
        $generateGaji      = $this->generateGajiUtility->saveGenerateGaji($karyawan, $absensiPerPeriode, $request);
        if (!$generateGaji['status']) {
            return redirect()->back()->with(['error' => $generateGaji['message']]);
        }
        return redirect()->back();
    }

    public function detailGaji($id){
        $detailGaji = $this->detailGaji->getDetailGajiById($id);
        $absen      = $this->queryAbsensi->getAbsensiByKaryawanIdAndPeriodeRange($detailGaji);
        $potongan   = Potongan::with([])->get();
        return view('layout-admin.detail-gaji.detail', compact('detailGaji', 'absen', 'potongan'));
    }

    public function pdf($id){
        $detailGaji = $this->detailGaji->getDetailGajiById($id);
        $absen      = $this->queryAbsensi->getAbsensiByKaryawanIdAndPeriodeRange($detailGaji);
        $potongan   = Potongan::with([])->get();

        $data = [
            'detailGaji' => $detailGaji, 
            'absen'      => $absen, 
            'potongan'   => $potongan
        ];

        $pdf = PDF::loadView('layout-admin.detail-gaji.pdf', $data);
        return $pdf->download('laporan-pdf.pdf');
    }

    public function getExcel(Request $request){
        $result = $this->generateGajiUtility->exportToExcel($request);
        return redirect()->back()->with(['error' => $result['message']]);
    }

}
