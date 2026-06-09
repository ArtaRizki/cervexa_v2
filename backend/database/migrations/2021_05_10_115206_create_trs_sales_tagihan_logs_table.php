<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsSalesTagihanLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_sales_tagihan_logs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('idcust')->default('');
            $table->string('nobayar')->default('');
            $table->string('nonota')->default('');
            $table->string('sales')->default('');
            $table->integer('jmlcetak')->default(0);
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
        Schema::dropIfExists('trs_sales_tagihan_logs');
    }
}
