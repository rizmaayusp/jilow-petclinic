<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking_kliniks', function (Blueprint $table) {
            $table->unsignedBigInteger('time_slot_id')->nullable()->after('tanggal_booking');

            $table->foreign('time_slot_id')->references('id')->on('time_slots')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('booking_kliniks', function (Blueprint $table) {
            $table->dropForeign(['time_slot_id']);
            $table->dropColumn('time_slot_id');
        });
    }
};
