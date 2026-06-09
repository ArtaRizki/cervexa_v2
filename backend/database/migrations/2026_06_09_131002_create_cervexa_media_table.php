<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCervexaMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cervexa_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->string('type'); // snapshot, video
            $table->string('original_name');
            $table->string('public_url');
            $table->unsignedBigInteger('file_size');
            $table->string('mime_type');
            $table->timestamps();

            $table->foreign('session_id')->references('id')->on('cervexa_sessions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cervexa_media');
    }
}
