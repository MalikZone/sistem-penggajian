<?php


namespace App\Http\QueryRepositories;

use App\DetailGaji;

class QueryDetailGaji {

    public function detailGajiListByPeriode($filters){
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

    public function detailGajiListBy(){
       return DetailGaji::with(['karyawan'])->get();
    }

    public function getDetailGajiById($id){
        return DetailGaji::with(['karyawan'])
                        ->orderBy('id', 'DESC')
                        ->find($id); 
    }

}