<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsPoinHistajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_poin_histajuan', function (Blueprint $table) {
            $table->id();
            $table->date('cutoff');
            $table->date('awal');
            $table->date('akhir');
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
        Schema::dropIfExists('trs_poin_histajuan');
    }
}
