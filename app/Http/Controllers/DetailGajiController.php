<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\DetailGaji;
use App\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailGajiController extends Controller
{

    public function countingAbsent($from, $to){
        $absen = Absensi::with(['karyawan.gaji'])
                ->select('karyawan_id', DB::raw('count(*) as total_absen'))
                ->groupBy('karyawan_id')
                ->whereBetween('tanggal', [$from, $to])
                ->get();
        return $absen; 
    }

    public function deduction($gaji, $absen){
        $deduction      = $gaji * (1/100);
        $totalDeduction = $deduction * $absen;
        return $totalDeduction;
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
        $karyawan = Karyawan::with(['divisi', 'gaji', 'absensi'])->get();    
        foreach ($karyawan as $value) {
            $totalDeduction = 0;
            $absen          = $this->countingAbsent($request->periode_form, $request->periode_to);
            foreach ($absen as $item) {
                if ($item->karyawan_id == $value->id) {
                    $totalDeduction = $this->deduction($value->gaji->gaji, $item->total_absen);
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

    public function detailGaji($id){
        $detailGaji = DetailGaji::with(['karyawan'])
                        ->orderBy('id', 'DESC')
                        ->find($id);
        $absen      = Absensi::with(['karyawan'])
                        ->whereBetween('tanggal', [$detailGaji->periode_from, $detailGaji->periode_to])
                        ->where('karyawan_id', $detailGaji->karyawan_id)
                        ->get();
        return view('layout-admin.detail-gaji.detail', compact('detailGaji', 'absen'));
    }
}
