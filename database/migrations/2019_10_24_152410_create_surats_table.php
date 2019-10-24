<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_surat');
            $table->bigInteger('kode_surat_id')->unsigned();
            $table->string('kategori');
            $table->string('tipe');
            $table->string('judul');
            $table->text('keterangan');
            $table->text('file_surat');
            $table->string('status');
            $table->timestamps();

            $table->foreign('kode_surat_id')->references('id')->on('kode_surat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surats');
    }
}
