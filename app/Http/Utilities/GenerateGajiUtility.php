<?php

namespace App\Http\Utilities;

use App\DetailGaji;
use App\Http\QueryRepositories\QueryDetailGaji;
use App\Potongan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;



class GenerateGajiUtility {

    protected $detailGaji;

    public function __construct() {
        $this->detailGaji           = new QueryDetailGaji;
    }

    public function deductionAbsen($gaji, $absen){
        $deductionAbsensi       = $gaji * (1/100);
        $totalDeductionAbsen    = $deductionAbsensi * $absen;
        return $totalDeductionAbsen;
    }

    public function deductionLate($gaji, $late){
        $deductionLate      = $gaji * (0.5/100);
        $totalDeductionLate = $deductionLate * $late;
        return $totalDeductionLate;
    }

    public function deductionEtc(){
        return Potongan::with([])
                        ->sum('potongan');
    }
    
    public function saveGenerateGaji($karyawan, $absensiPerPeriode, $request){
        $result = [
            'status'  => false,
            'message' => ''
        ];
        foreach ($karyawan as $value) {
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
                return $result;
            } catch (\exception $e) {
                $result['message'] = 'untuk menghitung gaji, tanggal awal dan akhir periode harus diisi';
                return $result;
            }
        }
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
            if (!$filters) {
                $detailGaji = $this->detailGaji->detailGajiListBy($filters);
                $name       = 'Laporan gaji keseluruhan';
            } else {
                $detailGaji       = $this->detailGaji->detailGajiListByPeriode($filters); 
                $name = 'Laporan gaji periode '.$filters['periode_from'].'-'.$filters['periode_to'];
            }
    
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