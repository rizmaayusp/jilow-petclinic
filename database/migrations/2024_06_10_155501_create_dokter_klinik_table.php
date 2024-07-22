<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokterKlinikTable extends Migration
{
    public function up()
    {
        Schema::create('dokter_klinik', function (Blueprint $table) {
            $table->id('id_dokter');
            $table->string('nama_dokter');
            $table->unsignedBigInteger('id_cabang_klinik');
            $table->foreign('id_cabang_klinik')->references('id_cabang_klinik')->on('cabang_klinik')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokter_klinik');
    }
}


