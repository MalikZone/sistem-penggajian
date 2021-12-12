<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function gaji()
    {
        return $this->hasOne(Gaji::class);
    }

    public function detail_gaji()
    {
        return $this->hasOne(DetailGaji::class);
    }
}
