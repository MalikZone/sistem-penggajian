<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KeuanganSeeder extends Seeder
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
                'name'      => 'Admin Keuangan',
                'email'     => 'keuangan@admin.admin',
                'role'      => 'admin-keuangan',
                'password'  => Hash::make('qwerty'),
            ]
        );
    }
}
