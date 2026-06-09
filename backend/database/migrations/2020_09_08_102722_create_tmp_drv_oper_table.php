<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmpDrvOperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_drv_oper', function (Blueprint $table) {
            $table->id();
            $table->string('reff');
            $table->string('nokend');
            $table->string('tonokend');
            $table->string('idprod');
            $table->string('ball');
            $table->string('pcs');
            $table->string('status');
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
        Schema::dropIfExists('tmp_drv_oper');
    }
}
