<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstIvProdukTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('mst_iv_produk', function (Blueprint $table) {
      $table->id();
      $table->date('mulai');
      $table->string('cabang', 30)->default('');
      $table->string('idprod', 10)->default('');
      $table->float('nominal')->default(0);
      $table->bigInteger('user_id')->default(0);
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
    Schema::dropIfExists('mst_iv_produk');
  }
}
