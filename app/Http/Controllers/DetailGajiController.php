<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\DetailGaji;
use App\Karyawan;
use App\Potongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailGajiController extends Controller
{

    // public function countingAbsent($from, $to){
    //     $absen = Absensi::with(['karyawan.gaji'])
    //             ->select('karyawan_id', DB::raw('count(*) as total_absen'))
    //             ->groupBy('karyawan_id')
    //             ->whereBetween('tanggal', [$from, $to])
    //             ->get();
    //     return $absen; 
    // }

    // public function deduction($gaji, $absen){
    //     $deduction        = $gaji * (1/100);
    //     $deductionAbsensi = $deduction * $absen;
    //     $deductionEtc     = $this->deductionEtc();
    //     $totalDeduction   = $deductionAbsensi + $deductionEtc;
    //     return $totalDeduction;
    // }

    public function deductionAbsen($gaji, $absen){
        $deductionAbsensi       = $gaji * (5/100);
        $totalDeductionAbsen    = $deductionAbsensi * $absen;
        return $totalDeductionAbsen;
    }

    public function deductionLate($gaji, $late){
        $deductionLate      = $gaji * (3/100);
        $totalDeductionLate = $deductionLate * $late;
        return $totalDeductionLate;

    }

    public function getAbsensiPerPeriode($from, $to){
        $absensi = Absensi::with(['karyawan.gaji'])
                ->where([
                    'periode_from' => $from,
                    'periode_to'   => $to,
                ])
                ->get();
        return $absensi;
    }

    public function deductionEtc(){
        $deductionEtc = Potongan::with([])
                        ->sum('potongan');
        return $deductionEtc;
    }

    public function index(){
        $detailGaji = DetailGaji::with(['karyawan'])
                    ->orderBy('id', 'DESC')
                    ->get();
        return view('layout-admin.detail-gaji.index', compact('detailGaji'));
    }

    public function GenerateGaji(Request $request){

        $result = [
            'status'  => false,
            'message' => ''
        ];               
        $karyawan = Karyawan::with(['divisi', 'gaji', 'absensi', 'golongan'])->get();
        foreach ($karyawan as $value) {
            $absensiPerPeriode = $this->getAbsensiPerPeriode($request->periode_form, $request->periode_to);
            foreach ($absensiPerPeriode as $item) {
                if ($item->absen != 0 || $item->late != 0) {
                    $deductionAbsen  = $this->deductionAbsen($value->gaji->gaji, $item->absen);
                    $deductionLate   = $this->deductionLate($value->gaji->gaji, $item->late);
                    $totalDeduction  = $deductionAbsen + $deductionLate + $this->deductionEtc();
                } else {
                    $totalDeduction  = $this->deductionEtc();
                }
            }
            try {
                $detailGaji = new DetailGaji();
                $detailGaji->karyawan_id   = $value->id;
                $detailGaji->gaji_Pokok    = $value->gaji->gaji;
                $detailGaji->periode_from  = $request->periode_form;
                $detailGaji->periode_to    = $request->periode_to;
                $detailGaji->potongan      = $totalDeduction;
                $detailGaji->total_gaji    = $value->gaji->gaji - $totalDeduction;
                $detailGaji->save();
    
                $result['status']  = true;
                $result['message'] = 'generate gaji success';
            } catch (\exception $e) {
                $result['message'] = 'function GenerateGaji() fail => ' . $e->getMessage();
            }
        }
        return redirect()->back();
    }

    // public function GenerateGaji(Request $request){

    //     $result = [
    //         'status'  => false,
    //         'message' => ''
    //     ];               
    //     $karyawan = Karyawan::with(['divisi', 'gaji', 'absensi'])->get();   
    //     foreach ($karyawan as $value) {
    //         $totalDeduction = $this->deductionEtc();
    //         $absen          = $this->countingAbsent($request->periode_form, $request->periode_to);
    //         foreach ($absen as $item) {
    //             if ($item->karyawan_id == $value->id) {
    //                 $totalDeduction = $this->deduction($value->gaji->gaji, $item->total_absen);
    //             }
    //         }
    //         try {
    //             $detailGaji = new DetailGaji();
    //             $detailGaji->karyawan_id   = $value->id;
    //             $detailGaji->gaji_Pokok    = $value->gaji->gaji;
    //             $detailGaji->periode_from  = $request->periode_form;
    //             $detailGaji->periode_to    = $request->periode_to;
    //             $detailGaji->potongan      = $totalDeduction;
    //             $detailGaji->total_gaji    = $value->gaji->gaji - $totalDeduction;
    //             $detailGaji->save();
    
    //             $result['status']  = true;
    //             $result['message'] = 'generate gaji success';
    //         } catch (\exception $e) {
    //             $result['message'] = 'function GenerateGaji() fail => ' . $e->getMessage();
    //         }
    //     }
    //     return redirect()->back();
    // }

    public function detailGaji($id){
        $detailGaji = DetailGaji::with(['karyawan'])
                        ->orderBy('id', 'DESC')
                        ->find($id);
        $absen      = Absensi::with(['karyawan'])
                        ->where('periode_from', $detailGaji->periode_to)
                        ->orWhere('periode_to', $detailGaji->periode_to)
                        ->orWhere('karyawan_id', $detailGaji->karyawan_id)
                        ->get();
        $potongan   = Potongan::with([])->get();
        return view('layout-admin.detail-gaji.detail', compact('detailGaji', 'absen', 'potongan'));
    }
}
