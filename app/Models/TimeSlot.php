<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $table = 'time_slots';
    protected $fillable = ['slot'];

    // Relasi dengan BookingKlinik
    public function bookings()
    {
        return $this->hasMany(BookingKlinik::class, 'time_slot_id');
    }
}
