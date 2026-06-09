<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsProdukSatuanTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trs_produk_satuan', function (Blueprint $table) {
      $table->id();
      $table->date('mulai');
      $table->string('idprod', 10)->default('');
      $table->string('nama', 30)->default('');
      $table->string('nama2', 100)->default('');
      $table->integer('berat')->default(0);
      $table->string('satuan', 10)->default('');
      $table->bigInteger('deleted_id')->default(0);
      $table->softDeletes();
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
    Schema::dropIfExists('trs_produk_satuan');
  }
}
