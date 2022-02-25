<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\DetailGaji;
use App\Karyawan;
use App\Potongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Mpdf\Mpdf;
use PDF;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;

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

    public function index(Request $request){
        $user       = Auth()->user();
        $detailGaji = '';
        $filters    = $request->only([
            'periode_from','periode_to', 'name'
        ]);
        if ($user->role == 'karyawan') {
            $karyawan   = $this->findKaryawanByUserId($user->id);
            $detailGaji = $this->detailGajiByIdKaryawan($karyawan->id);
        } else {
            $detailGaji       = $this->detailGajiList($filters);
        }
        return view('layout-admin.detail-gaji.index', compact('detailGaji', 'filters'));
    }

    public function findKaryawanByUserId($userId){
        return Karyawan::with([])
            ->where('user_id', $userId)->first();
    }

    public function detailGajiByIdKaryawan($karyawanId){
        $data = DetailGaji::with(['karyawan']);
        return $data->where('karyawan_id', $karyawanId)->get();
    }

    public function detailGajiList($filters){
        $data = DetailGaji::with(['karyawan']);
        if (isset($filters['periode_from']) && (isset($filters['periode_to']))) {
            $data = $data->where([
                'periode_from' => $filters['periode_from'],
                'periode_to'   => $filters['periode_to'],
            ]);
        }
        if (isset($filters['name'])) {
            $data = $data->whereHas('karyawan', function ($query) use ($filters) {
                $query->where('nama', 'like', '%' . $filters['name'] . '%');
            });
        }
        return $data->get();
    }

    public function GenerateGaji(Request $request){

        $result = [
            'status'  => false,
            'message' => ''
        ];               
        $karyawan = Karyawan::with(['divisi', 'gaji', 'absensi', 'golongan'])->get();
        foreach ($karyawan as $value) {
            $absensiPerPeriode = $this->getAbsensiPerPeriode($request->periode_form, $request->periode_to);
            $tunjanganGolongan = $value->golongan->tunjangan;
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
                $detailGaji->total_gaji    = $value->gaji->gaji + $tunjanganGolongan - $totalDeduction;
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
        
        $detailGaji = DetailGaji::with(['karyawan.golongan'])
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

    public function pdf($id){
        $detailGaji = DetailGaji::with(['karyawan'])
                        ->orderBy('id', 'DESC')
                        ->find($id);
        $absen      = Absensi::with(['karyawan'])
                        ->where('periode_from', $detailGaji->periode_to)
                        ->orWhere('periode_to', $detailGaji->periode_to)
                        ->orWhere('karyawan_id', $detailGaji->karyawan_id)
                        ->get();
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
        $result = $this->exportToExcel($request);
        return redirect()->back()->with(['error' => $result['message']]);
    }


    public function exportToExcel($request){
        try {
            $result = [
                'status'  => false,
                'message' => ''
            ];    

            $filters    = $request->only([
                'periode_from','periode_to'
            ]);
            $detailGaji = $this->detailGajiList($filters);   
    
            $spreadsheet = new Spreadsheet();
            $key = 1;
            $sheet          = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A' . $key, "Id")->getStyle('A' . $key);
            $sheet->setCellValue('B' . $key, "Nama")->getStyle('B' . $key);
            $sheet->setCellValue('C' . $key, "Gaji Pokok")->getStyle('C' . $key);
            $sheet->setCellValue('D' . $key, "Potongan")->getStyle('D' . $key);
            $sheet->setCellValue('E' . $key, "Terbayar")->getStyle('E' . $key);
            
    
            $key = 2;
            foreach ($detailGaji as $item) {
                $sheet->setCellValue('A' . $key, $item->id)->getStyle('A' . $key);
                $sheet->setCellValue('B' . $key, $item->karyawan->nama)->getStyle('B' . $key);
                $sheet->setCellValue('C' . $key, number_format($item->gaji_pokok, 0))->getStyle('C' . $key);
                $sheet->setCellValue('D' . $key, number_format($item->potongan, 0))->getStyle('D' . $key);
                $sheet->setCellValue('E' . $key, number_format($item->total_gaji, 0))->getStyle('E' . $key);
                $key++;
            }
            $writer = new WriterXlsx($spreadsheet);
            ob_end_clean(); 
            $name = 'Laporan gaji periode '.$filters['periode_from'].'-'.$filters['periode_to'];
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . $name . '.xlsx"');
            $writer->save("php://output");
            exit();
            return '';
        } catch (\Throwable $e) {
            return $result['message'] = 'function exportExcel() fail => ' . $e->getMessage();
        }
    }

}
