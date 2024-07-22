<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingKliniksTable extends Migration
{
    public function up()
    {
        Schema::create('booking_klinik', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_user');
            $table->string('email_user');
            $table->string('telepon_user');
            $table->unsignedInteger('id_cabang_klinik');
            $table->unsignedInteger('id_dokter');
            $table->unsignedInteger('id_layanan');
            $table->date('tanggal_booking');
            $table->unsignedInteger('time_slot_id')->nullable();
            $table->enum('status', ['PENDING', 'DITERIMA', 'DITOLAK']);
            $table->text('catatan')->nullable();
            $table->timestamps();


            $table->foreign('id_cabang_klinik')->references('id_cabang_klinik')->on('cabang_klinik')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id_dokter')->on('dokter_klinik')->onDelete('cascade');
            $table->foreign('id_layanan')->references('id_layanan')->on('layanans')->onDelete('cascade');
            $table->foreign('time_slot_id')->references('id')->on('time_slots')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::table('booking_kliniks', function (Blueprint $table) {
            $table->id('id_booking');
            $table->string('nama_user');
            $table->string('email_user');
            $table->string('telepon_user');
            $table->unsignedBigInteger('id_dokter');
            $table->unsignedBigInteger('id_cabang_klinik');
            $table->unsignedBigInteger('id_layanan');
            $table->date('tanggal_booking');
            $table->text('catatan')->nullable();
            $table->string('status')->default('pending')->after('catatan');
            $table->timestamps();
        });
    }
}
