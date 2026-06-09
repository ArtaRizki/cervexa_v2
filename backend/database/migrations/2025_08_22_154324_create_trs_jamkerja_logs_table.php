<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsJamkerjaLogsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trs_jamkerja_logs', function (Blueprint $table) {
      $table->id();
      $table->date('tgl_mulai');
      $table->string('karyawan_id', 5)->default('');
      $table->string('bagian_id', 5)->default('');
      $table->integer('jml_hari_kerja_awal')->default(0);
      $table->integer('jml_hari_kerja_akhir')->default(0);
      $table->string('request_id', 5)->default('');
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
    Schema::dropIfExists('trs_jamkerja_logs');
  }
}
