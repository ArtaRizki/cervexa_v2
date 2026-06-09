<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsRiderBiaya extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_rider_biaya', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal');
            $table->string('nokend')->default('');
            $table->string('sales')->default('');
            $table->string('idbiaya')->default('');
            $table->dateTime('waktu');
            $table->float('total')->default(0);
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
        Schema::dropIfExists('trs_rider_biaya');
    }
}
