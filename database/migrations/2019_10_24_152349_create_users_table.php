<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama');
            $table->string('nip');
            $table->text('alamat');
            $table->string('telepon');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('status');
            $table->string('role');
            $table->bigInteger('jabatan_id')->unsigned();
            $table->bigInteger('bidang_id')->unsigned();
            $table->bigInteger('posisi_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('jabatan_id')->references('id')->on('jabatan');
            $table->foreign('bidang_id')->references('id')->on('bidang');
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
        Schema::dropIfExists('users');
    }
}
