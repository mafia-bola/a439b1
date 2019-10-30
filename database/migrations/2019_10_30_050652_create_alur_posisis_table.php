<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlurPosisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alur_posisi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('alur_id')->unsigned();
            $table->bigInteger('posisi_id')->unsigned();
            $table->integer('urut');
            $table->timestamps();

            $table->foreign('alur_id')->references('id')->on('alur');
            $table->foreign('posisi_id')->references('id')->on('posisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alur_posisi');
    }
}
