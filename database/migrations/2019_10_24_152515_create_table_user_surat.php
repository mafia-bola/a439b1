<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserSurat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_surat', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('surat_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('surat_id')->references('id')->on('surat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_surat');
    }
}
