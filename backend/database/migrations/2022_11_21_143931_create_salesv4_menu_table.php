<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesv4MenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_salesv4_menu_rinci', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->default('');
            $table->string('deskripsi')->default('');
            $table->string('slug')->default('');
            $table->boolean('aktif')->default(0);
            $table->bigInteger('group')->default(0);
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
        Schema::dropIfExists('salesv4_menu');
    }
}
