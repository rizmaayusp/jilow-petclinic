<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';

    protected $primaryKey = 'id_layanan';

    protected $fillable = [
        'gambar_layanan',
        'nama_layanan',
        'kategori_id',
        'deskripsi_layanan',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    public function bookings()
    {
        return $this->hasMany(BookingKlinik::class, 'id_layanan');
    }

    public function testimoni()
    {
        return $this->hasMany(Testimoni::class, 'id_layanan', 'id_layanan');
    }

}
