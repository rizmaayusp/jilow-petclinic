<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterKlinik extends Model
{
    use HasFactory;

    protected $table = 'dokter_klinik';

    protected $primaryKey = 'id_dokter';

    protected $fillable = [
        'nama_dokter',
        'id_cabang_klinik',
    ];

    public function cabangKlinik()
    {
        return $this->belongsTo(CabangKlinik::class, 'id_cabang_klinik');
    }

    public function bookings()
    {
        return $this->hasMany(BookingKlinik::class, 'id_dokter');
    }
}

