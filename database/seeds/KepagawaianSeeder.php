<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KepagawaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name'      => 'Admin Kepegawaian',
                'email'     => 'kepegawaian@admin.admin',
                'role'      => 'admin-kepegawain',
                'password'  => Hash::make('qwerty'),
            ]
        );

        DB::table('divisi')->insert(
            [
                'divisi'      => 'Hubungan Masyarakat',
            ]
        );

        DB::table('golongans')->insert(
            [
                'golongan'      => 'Golongan IV',
                'tunjangan'     => 10000000,
            ]
        );

        DB::table('potongan')->insert(
            [
                'keterangan'      => 'Zakat',
                'potongan'     => 200000,
            ]
        );
    }
}
