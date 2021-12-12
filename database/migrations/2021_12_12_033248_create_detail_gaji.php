<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_gaji', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->decimal('gaji_pokok', 12, 2);
            $table->date('periode_from');
            $table->date('periode_to');
            $table->decimal('potongan', 12, 2);
            $table->decimal('total_gaji', 12, 2);
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
        Schema::dropIfExists('detail_gaji');
    }
}
