<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsSalesComplaintsRinciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_sales_complaints_rinci', function (Blueprint $table) {
            $table->id();
            $table->string('idkomplain');
            $table->string('idprod');
            $table->integer('jmlpeti');
            $table->integer('jmlsatu');
            $table->string('expdate');
            $table->string('batchno');
            $table->string('keluhan');
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
        Schema::dropIfExists('trs_sales_complaints_rinci');
    }
}
