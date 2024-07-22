<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $table = 'testimoni';
    protected $primaryKey = 'id_testimoni';

    protected $fillable = [
        'id_booking',
        'id_layanan',
        'konten',
    ];

    public function booking_kliniks()
    {
        return $this->belongsTo(BookingKlinik::class, 'id_booking');
    }

    public function layanans()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }
}
