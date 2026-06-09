<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsSalesUbahkunjungDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_sales_ubahkunjung_detail', function (Blueprint $table) {
            $table->id();
            $table->string('nopkh')->default('');
            $table->string('idcust')->default('');
            $table->string('nonota')->default('');
            $table->string('idprod')->default('');
            $table->integer('isipeti')->default(0);
            $table->integer('isisatu')->default(0);
            $table->float('nominal')->default(0);
            $table->string('jenis')->default('');
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
        Schema::dropIfExists('trs_sales_ubahkunjung_detail');
    }
}
