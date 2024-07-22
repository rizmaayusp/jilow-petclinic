<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingKlinik;
use App\Notifications\BookingStatusNotification;

class AdminController extends Controller
{
    public function updateStatus(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:booking_kliniks,id_booking',
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $booking = BookingKlinik::find($request->booking_id);
        $booking->status = $request->status;
        $booking->note = $request->note;
        $booking->save();

        // Kirim email konfirmasi jika status DITERIMA atau DITOLAK
        if ($request->status == 'DITERIMA' || $request->status == 'DITOLAK') {
            $this->sendEmailNotification($booking);
        }

        $statusText = '';
        switch ($request->status) {
            case 'PENDING':
                $statusText = 'Pending';
                break;
            case 'DITERIMA':
                $statusText = 'Booking Diterima';
                break;
            case 'DITOLAK':
                $statusText = 'Booking Ditolak';
                break;
            default:
                $statusText = '';
        }

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui menjadi ' . $statusText);
    }

    protected function sendEmailNotification($booking)
    {
        $booking->notify(new BookingStatusNotification($booking));
    }
}
