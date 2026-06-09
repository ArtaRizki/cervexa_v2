<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsPoinPengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_poin_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('idcust')->default('');
            $table->bigInteger('id_giftpoin')->default(0);
            $table->bigInteger('created_id')->default(0);
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
        Schema::dropIfExists('trs_poin_pengajuan');
    }
}
