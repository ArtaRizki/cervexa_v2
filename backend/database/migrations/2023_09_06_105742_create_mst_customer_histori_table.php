<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstCustomerHistoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_customer_histori', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_mulai');
            $table->string('idcust', 10)->default('');
            $table->string('daerah_lama', 100)->default('');
            $table->string('daerah_baru', 100)->default('');
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
        Schema::dropIfExists('mst_customer_histori');
    }
}
