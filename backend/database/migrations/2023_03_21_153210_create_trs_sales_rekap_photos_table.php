<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsSalesRekapPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_sales_rekap_photos', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nokend', 10)->default('');
            $table->float('nota')->default(0);
            $table->string('photo', 30)->default('');
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
        Schema::dropIfExists('trs_sales_rekap_photos');
    }
}
