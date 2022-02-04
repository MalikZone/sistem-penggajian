<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $guarded = [];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }
}
