<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstProdukLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_produk_log', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal');
            $table->string('idprod')->default('');
            $table->float('harga')->default(0);
            $table->integer('rentang')->default(0);
            $table->string('status')->default('');
            $table->dateTime('akunt_create');
            $table->string('akunt_nama')->default('');
            $table->dateTime('pjual_acc');
            $table->string('pjual_nama')->default('');
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
        Schema::dropIfExists('mst_produk_log');
    }
}
