<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class BookingKlinik extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'booking_kliniks';

    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'nama_user',
        'email_user',
        'telepon_user',
        'id_dokter',
        'id_cabang_klinik',
        'id_layanan',
        'tanggal_booking',
        'time_slot_id',
        'catatan',
        'status',
        'note'
    ];

    // pagination halaman
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('nama_user', 'like', '%' . $search . '%')
                    ->orWhere('email_user', 'like', '%' . $search . '%')
                    ->orWhere('telepon_user', 'like', '%' . $search . '%');
            });
        });
    }

    // Relasi dengan TimeSlot
    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'time_slot_id');
    }

    public function routeNotificationForMail($notification)
    {
        return $this->email_user;
    }

    public function cabangKlinik()
    {
        return $this->belongsTo(CabangKlinik::class, 'id_cabang_klinik');
    }

    public function dokterKlinik()
    {
        return $this->belongsTo(DokterKlinik::class, 'id_dokter');
    }

    public function layanans()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }

    public function testimoni()
    {
        return $this->hasMany(Testimoni::class, 'id_booking', 'id_booking');
    }
}
