<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsDrvTagihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_drv_tagihan', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_bayar');
            $table->string('nokend_bayar', 15)->default('');
            $table->string('nota_bayar', 15)->default('');
            $table->date('tgl_tagihan');
            $table->string('nokend_tagihan', 15)->default('');
            $table->string('nota_tagihan', 15)->default('');
            $table->string('idcust', 10)->default('');
            $table->integer('bayar_peti')->default(0);
            $table->integer('bayar_satu')->default(0);
            $table->integer('bayar_bs_peti')->default(0);
            $table->integer('bayar_bs_satu')->default(0);
            $table->string('kel', 5)->default('');
            $table->string('cabang', 30)->default('');
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
        Schema::dropIfExists('trs_drv_tagihan');
    }
}
