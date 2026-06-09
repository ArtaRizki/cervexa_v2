<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsSalesNotaLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_sales_nota_logs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nokend');
            $table->string('idcust');
            $table->string('nonota');
            $table->integer('jmlcetak');
            $table->string('keterangan');
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
        Schema::dropIfExists('trs_sales_nota_logs');
    }
}
