<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->date('tanggal');
            $table->bigInteger('bagian_id')->unsigned();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('status')->default('menunggu');
            $table->text('keterangan')->default('-');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bagian_id')->references('id')->on('bagian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
}
