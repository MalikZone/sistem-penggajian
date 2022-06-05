<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $guarded = [];
    protected $table = 'golongans';

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }
}
