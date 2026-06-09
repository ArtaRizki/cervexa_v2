<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstSalesWorkorderTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('mst_sales_workorder', function (Blueprint $table) {
      $table->id();
      $table->date('tanggal');
      $table->string('cabang', 30)->default('');
      $table->string('kel', 10)->default('');
      $table->integer('workday')->default(0);
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
    Schema::dropIfExists('mst_sales_workorder');
  }
}
