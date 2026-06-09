<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmpCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_customer', function (Blueprint $table) {
            $table->id();
            $table->string('nopkb')->default('');
            $table->dateTime('tanggal');
            $table->string('nama')->default('');
            $table->string('ktp')->default('');
            $table->string('alamatrumah')->default('');
            $table->string('alamatusaha')->default('');
            $table->string('telp')->default('');
            $table->string('carabayar')->default('');
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
        Schema::dropIfExists('tmp_customer');
    }
}
