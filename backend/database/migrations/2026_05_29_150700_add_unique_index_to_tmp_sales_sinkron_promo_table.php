<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueIndexToTmpSalesSinkronPromoTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::connection('dev')->table('tmp_sales_sinkron_promo', function (Blueprint $table) {
      $table->unique(['tgl', 'sales'], 'ux_tmp_sales_sinkron_promo_tgl_sales');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::connection('dev')->table('tmp_sales_sinkron_promo', function (Blueprint $table) {
      $table->dropUnique('ux_tmp_sales_sinkron_promo_tgl_sales');
    });
  }
}
