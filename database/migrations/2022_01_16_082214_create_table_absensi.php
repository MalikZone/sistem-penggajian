<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAbsensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->date('periode_from');
            $table->date('periode_to');
            $table->integer('present')->default(0);
            $table->integer('absen')->default(0);
            $table->integer('sick')->default(0);
            $table->integer('late')->default(0);
            $table->integer('paid_leave')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_absensi');
    }
}
