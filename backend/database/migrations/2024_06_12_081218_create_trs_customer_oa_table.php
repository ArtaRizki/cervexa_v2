<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsCustomerOaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trs_customer_oa', function (Blueprint $table) {
      $table->id();
      $table->date('awal');
      $table->date('akhir');
      $table->string('cabang', 30)->default('');
      $table->string('kel', 10)->default('');
      $table->string('idcust', 10)->default('');
      $table->string('wilayah', 100)->default('');
      $table->date('firstorder_date');
      $table->date('outletactive_date');
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
    Schema::dropIfExists('trs_customer_oa');
  }
}
