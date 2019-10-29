<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dari_user')->unsigned();
            $table->bigInteger('ke_user')->unsigned();
            $table->bigInteger('dari_posisi')->unsigned();
            $table->bigInteger('ke_posisi')->unsigned();
            $table->bigInteger('surat_id')->unsigned();
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('dari_user')->references('id')->on('users');
            $table->foreign('ke_user')->references('id')->on('users');
            $table->foreign('dari_posisi')->references('id')->on('posisi');
            $table->foreign('ke_posisi')->references('id')->on('posisi');
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
        Schema::dropIfExists('disposisi');
    }
}
