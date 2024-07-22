<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabangKlinik extends Model
{
    use HasFactory;

    protected $table = 'cabang_klinik';

    protected $primaryKey = 'id_cabang_klinik';

    protected $fillable = [
        'nama_cabang',
        'alamat',
        'telepon',
    ];

    public function dokterKlinik()
    {
        return $this->hasMany(DokterKlinik::class, 'id_cabang_klinik');
    }

    public function bookings()
    {
        return $this->hasMany(BookingKlinik::class, 'id_cabang_klinik');
    }
}
