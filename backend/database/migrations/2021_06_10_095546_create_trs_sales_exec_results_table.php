<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsSalesExecResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_sales_exec_results', function (Blueprint $table) {
            $table->id();
            $table->string('idcommand')->default('');
            $table->longText('result')->default('');
            $table->date('exectime');
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
        Schema::dropIfExists('trs_sales_exec_results');
    }
}
