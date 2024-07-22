<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->bigIncrements('id_layanan');
            $table->string('gambar_layanan')->nullable();
            $table->string('nama_layanan');
            $table->unsignedBigInteger('kategori_id');
            $table->text('deskripsi_layanan');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('kategori_id')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layanans');
    }
}
