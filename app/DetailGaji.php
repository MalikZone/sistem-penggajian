<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailGaji extends Model
{
    protected $table = 'detail_gaji';

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
