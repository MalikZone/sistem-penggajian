<?php

namespace App\Http\QueryRepositories;

use App\Absensi;

class QueryAbsensi{

    public function getDataAbsensi(){
        return Absensi::with(['karyawan'])
                    ->orderBy('id', 'DESC')
                    ->get();
    }

    public function findAbsensiById($id){
        return Absensi::with([])
            ->find($id);
    }

    public function absenOnDate($id, $date){
        return Absensi::with([])
            ->where('karyawan_id', $id )
            ->Where('tanggal', $date)->first();
    }

    public function getAbsensiPerPeriode($from, $to){
        return Absensi::with(['karyawan.gaji'])
                ->where([
                    'periode_from' => $from,
                    'periode_to'   => $to,
                ])
                ->get();
    }

    public function getAbsensiByKaryawanIdAndPeriodeRange($detailGaji){
        return Absensi::with(['karyawan'])
                        ->where('periode_from', $detailGaji->periode_to)
                        ->orWhere('periode_to', $detailGaji->periode_to)
                        ->orWhere('karyawan_id', $detailGaji->karyawan_id)
                        ->get();
    }

}