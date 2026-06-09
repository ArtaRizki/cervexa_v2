<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstCustRoCutoff extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('mst_cust_ro_cutoff', function (Blueprint $table) {
      $table->id();
      $table->date('periode');
      $table->date('awal');
      $table->date('akhir');
      $table->bigInteger('deleted_id')->default(0);
      $table->softDeletes();
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
    Schema::dropIfExists('mst_cust_ro_cutoff');
  }
}
