<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsSalesUbahkunjungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_sales_ubahkunjung', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal');
            $table->string('nokend')->default('');
            $table->string('nopkh')->default('');
            $table->string('keterangan')->default('');
            $table->string('sales')->default('');
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
        Schema::dropIfExists('trs_sales_ubahkunjung');
    }
}
