<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingStatusNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Konfirmasi Booking')
                    ->line('Status booking Anda telah diperbarui.')
                    ->line('Status: ' . $this->booking->status)
                    ->line('Booking Anda telah dikonfirmasi dengan detail berikut:')
                    ->line('Nama User: ' . $this->booking->nama_user)
                    ->line('Email User: ' . $this->booking->email_user)
                    ->line('Nomor Telepon: ' . $this->booking->telepon_user)
                    ->line('Cabang Klinik: ' . $this->booking->cabangKlinik->nama_cabang)
                    ->line('Dokter: ' . $this->booking->dokterKlinik->nama_dokter)
                    ->line('Layanan: ' . $this->booking->layanans->nama_layanan)
                    ->line('Tanggal Booking: ' . $this->booking->tanggal_booking)
                    ->line('Waktu Booking: ' . $this->booking->timeSlot->slot)
                    ->line('Catatan: ' . $this->booking->note)
                    ->line('Terima kasih telah menggunakan layanan kami! Jika ingin melakukan reschedule atau pembatalan booking harap hubungi whatsapp kami di +62 856-4504-4363');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
