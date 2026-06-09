<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstKaryawanV2FacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_karyawan_v2_faces', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nip');
            $table->float('kiri');
            $table->float('atas');
            $table->float('kanan');
            $table->float('bawah');
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
        Schema::dropIfExists('mst_karyawan_v2_faces');
    }
}
