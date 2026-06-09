<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsSalesCompetitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_sales_competitors', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('sales')->default('');
            $table->string('daerah')->default('');
            $table->string('customer')->default('');
            $table->string('produsen')->default('');
            $table->string('produk')->default('');
            $table->string('kemasan')->default('');
            $table->float('berat')->default(0);
            $table->string('ukuran')->default('');
            $table->date('expdate');
            $table->float('hargabeli')->default(0);
            $table->float('hargajual')->default(0);
            $table->string('keterangan')->default('');
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
        Schema::dropIfExists('trs_sales_competitors');
    }
}
