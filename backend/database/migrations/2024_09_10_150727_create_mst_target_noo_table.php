<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstTargetNooTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('mst_target_noo', function (Blueprint $table) {
      $table->id();
      $table->date('mulai');
      $table->string('cabang', 30)->default('');
      $table->string('kel', 10)->default('');
      $table->integer('target')->default(0);
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
    Schema::dropIfExists('mst_target_noo');
  }
}
