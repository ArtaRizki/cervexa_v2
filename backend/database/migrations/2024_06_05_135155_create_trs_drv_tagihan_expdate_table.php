<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsDrvTagihanExpdateTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trs_drv_tagihan_expdate', function (Blueprint $table) {
      $table->id();
      $table->date('tanggal');
      $table->string('nokend', 15)->default('');
      $table->string('cabang', 30)->default('');
      $table->string('idcust', 10)->default('');
      $table->string('nonota', 15)->default('');
      $table->string('idprod', 10)->default('');
      $table->string('jenis', 10)->default('');
      $table->date('expdate');
      $table->string('kodeproduksi', 50)->default('');
      $table->integer('jmlpeti')->default(0);
      $table->integer('jmlsatu')->default(0);
      $table->bigInteger('user_id')->default(0);
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
    Schema::dropIfExists('trs_drv_tagihan_expdate');
  }
}
