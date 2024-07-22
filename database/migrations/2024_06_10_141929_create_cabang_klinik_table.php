<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabangKlinikTable extends Migration
{
    public function up()
    {
        Schema::create('cabang_klinik', function (Blueprint $table) {
            $table->id('id_cabang_klinik');
            $table->string('nama_cabang');
            $table->string('alamat');
            $table->string('telepon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cabang_klinik');
    }
}


