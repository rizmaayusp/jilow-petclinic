<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CabangKlinik;
use App\Models\DokterKlinik;
use App\Models\Layanan;
use App\Models\BookingKlinik;
use App\Models\TimeSlot; // Tambahkan ini
use App\Notifications\BookingStatusNotification;

class BookingController extends Controller
{
    // view page booking
    public function showBookings()
    {
        $cabangs = CabangKlinik::all();
        $dokters = DokterKlinik::all();
        $layanans = Layanan::all();
        $timeSlots = TimeSlot::all();
        $bookings = BookingKlinik::with(['cabangKlinik', 'dokterKlinik', 'layanans', 'timeSlot'])
            ->orderBy('created_at', 'desc')
            ->filter(request(['search']))
            ->paginate(5)
            ->withQueryString();
        return view('auth.pages.booking-status', compact('bookings', 'cabangs', 'dokters', 'timeSlots', 'layanans'));
    }


    // tambah booking
    public function addBooking(Request $request)
    {
        $validated = $request->validate([
            'nama_user' => 'required|string|max:255',
            'email_user' => 'required|email|max:255',
            'telepon_user' => 'required|string|max:255',
            'layanans' => 'required|exists:layanans,id_layanan',
            'tanggal_booking' => 'required|date',
            'slots' => 'required|exists:time_slots,id',
            'catatan' => 'nullable|string',
        ]);

        // Menentukan cabang dan dokter (logika bisa disesuaikan)
        // Misal: Menggunakan cabang dan dokter default
        $defaultCabangId = 1; // ID cabang default
        $defaultDokterId = 1; // ID dokter default

        BookingKlinik::create([
            'nama_user' => $validated['nama_user'],
            'email_user' => $validated['email_user'],
            'telepon_user' => $validated['telepon_user'],
            'id_cabang_klinik' => $defaultCabangId,
            'id_dokter' => $defaultDokterId,
            'id_layanan' => $validated['layanans'],
            'tanggal_booking' => $validated['tanggal_booking'],
            'time_slot_id' => $validated['slots'], // Update ini
            'catatan' => $validated['catatan'],
            'status' => 'PENDING',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil ditambahkan.');
    }

    // edit booking
    public function updateBooking(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_user' => 'required|string|max:255',
            'email_user' => 'required|email|max:255',
            'telepon_user' => 'required|string|max:255',
            'layanans' => 'required|exists:layanans,id_layanan',
            'tanggal_booking' => 'required|date',
            'slots' => 'required|exists:time_slots,id',
            'catatan' => 'nullable|string',
        ]);

        // Menentukan nilai default untuk cabang_klinik dan dokter_klinik jika tidak disertakan dalam request
        $cabang_klinik = $request->input('cabang_klinik', 1); // Nilai default untuk cabang klinik
        $dokter_klinik = $request->input('dokter_klinik', 1); // Nilai default untuk dokter klinik

        $booking = BookingKlinik::find($id);

        $booking->nama_user = $validated['nama_user'];
        $booking->email_user = $validated['email_user'];
        $booking->telepon_user = $validated['telepon_user'];
        $booking->id_cabang_klinik = $cabang_klinik;
        $booking->id_dokter = $dokter_klinik;
        $booking->id_layanan = $validated['layanans'];
        $booking->tanggal_booking = $validated['tanggal_booking'];
        $booking->time_slot_id = $validated['slots'];
        $booking->catatan = $validated['catatan'];

        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil diperbarui.');
    }

    // delete booking
    public function deleteBooking($id)
    {
        $booking = BookingKlinik::find($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking berhasil dihapus.');
    }

    public function create()
    {
        $timeSlots = TimeSlot::all();
        return view('auth.pages.create-booking', compact('timeSlots'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $booking = BookingKlinik::findOrFail($id);
        $booking->update([
            'status' => $request->status,
            'note' => $request->note,
        ]);

        if ($request->status == 'DITERIMA' || $request->status == 'DITOLAK') {
            $this->sendEmailNotification($booking);
        }

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }

    // RECAP BOOKING CONTROLLER
    public function rekapHarian(Request $request)
    {
        $tanggal = $request->input('tanggal', date('Y-m-d')); // Default tanggal hari ini

        $acceptedBookings = BookingKlinik::whereDate('tanggal_booking', $tanggal)
                                        ->where('status', 'DITERIMA')
                                        ->paginate(10, ['*'], 'acceptedPage');

        $rejectedBookings = BookingKlinik::whereDate('tanggal_booking', $tanggal)
                                        ->where('status', 'DITOLAK')
                                        ->paginate(10, ['*'], 'rejectedPage');

        $layanans = Layanan::all(); // Mengambil semua layanan

        // Mendapatkan tahun-tahun unik dari data booking
        $years = BookingKlinik::selectRaw('YEAR(tanggal_booking) as year')
        ->distinct()
        ->orderBy('year', 'asc')
        ->pluck('year');

        return view('auth.pages.rekap-booking', compact('tanggal', 'acceptedBookings', 'rejectedBookings', 'layanans' , 'years'));
    }


    protected function sendEmailNotification($booking)
    {
        $booking->notify(new BookingStatusNotification($booking));
    }

    public function getDokters($id)
    {
        $dokters = DokterKlinik::where('id_cabang_klinik', $id)->get();
        return response()->json($dokters);
    }


    public function submitBooking(Request $request)
    {
        $validated = $request->validate([
            'nama_user' => 'required|string|max:255',
            'email_user' => 'required|email|max:255',
            'telepon_user' => 'required|string|max:255',
            'cabang_klinik' => 'required|exists:cabang_klinik,id_cabang_klinik',
            'dokter_klinik' => 'required|exists:dokter_klinik,id_dokter',
            'layanans' => 'required|exists:layanans,id_layanan',
            'tanggal_booking' => 'required|date',
            'slots' => 'required|exists:time_slots,id',
            'catatan' => 'nullable|string',
        ]);

        BookingKlinik::create([
            'nama_user' => $validated['nama_user'],
            'email_user' => $validated['email_user'],
            'telepon_user' => $validated['telepon_user'],
            'id_cabang_klinik' => $validated['cabang_klinik'],
            'id_dokter' => $validated['dokter_klinik'],
            'id_layanan' => $validated['layanans'],
            'tanggal_booking' => $validated['tanggal_booking'],
            'time_slot_id' => $validated['slots'], // Update ini
            'catatan' => $validated['catatan'],
            'status' => 'PENDING',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil! Harap cek email untuk konfirmasi.');
    }


    // CHART 1 (method untuk mengambil data booking per bulan)
    public function getBookingDataPerDay()
    {
        // Mengambil data booking per hari
        $data = BookingKlinik::selectRaw('DATE_FORMAT(tanggal_booking, "%Y-%m-%d") as day, COUNT(*) as count')
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return response()->json($data);
    }


    // CHART 2 menunjukkan jumlah booking berdasarkan status (DITERIMA, DITOLAK, PENDING)
    public function getBookingDataByStatus()
    {
        // Pastikan logika ini benar dan mengembalikan data yang diperlukan
        $data = BookingKlinik::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();
        return response()->json($data);
    }

    // FUNCTION BAWAHNYA YG ITUNGANNYA DROPDOWN PER TAHUN AJA (SEMUA LAYANAN) (HALAMAN RECAP BOOKING)
    public function getBookingDataByServicePerMonth(Request $request)
    {
        try {
            $year = $request->query('year', date('Y'));

            $data = BookingKlinik::selectRaw('DATE_FORMAT(booking_kliniks.tanggal_booking, "%Y-%m") as month, layanans.nama_layanan as layanan, COUNT(*) as count')
                ->join('layanans', 'booking_kliniks.id_layanan', '=', 'layanans.id_layanan')
                ->whereYear('booking_kliniks.tanggal_booking', $year)
                ->groupBy('month', 'layanans.nama_layanan')
                ->orderBy('month')
                ->get();

            $result = $data->groupBy('layanan')->map(function($item, $key) {
                return [
                    'layanan' => $key,
                    'data' => $item->map(function($entry) {
                        return [
                            'month' => $entry->month,
                            'count' => $entry->count,
                        ];
                    })
                ];
            })->values();

            return response()->json($result);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    // FUNCTION CHART BERDASARKAN DROPDOWN LAYANAN DAN TAHUN (HALAMAN REKAP BOOKING)
    public function getBookingData(Request $request)
    {
        $layananId = $request->query('layanan_id');
        $year = $request->query('year', date('Y'));
        $month = $request->query('month');

        try {
            $query = BookingKlinik::selectRaw('booking_kliniks.id_layanan, layanans.nama_layanan, DATE_FORMAT(booking_kliniks.tanggal_booking, "%Y-%m") as period, COUNT(*) as count')
                ->join('layanans', 'booking_kliniks.id_layanan', '=', 'layanans.id_layanan')
                ->when($layananId, function ($query) use ($layananId) {
                    return $query->where('booking_kliniks.id_layanan', $layananId);
                })
                ->when($year, function ($query) use ($year) {
                    return $query->whereYear('booking_kliniks.tanggal_booking', $year);
                })
                ->when($month, function ($query) use ($month) {
                    return $query->whereMonth('booking_kliniks.tanggal_booking', $month);
                })
                ->groupBy('booking_kliniks.id_layanan', 'layanans.nama_layanan', 'period')
                ->orderBy('period')
                ->get();

            $result = $query->groupBy('id_layanan')->map(function($group) {
                return [
                    'layanan' => $group->first()->nama_layanan,
                    'data' => $group->map(function($entry) {
                        return [
                            'period' => $entry->period,
                            'count' => $entry->count,
                        ];
                    })
                ];
            })->values();

            return response()->json($result);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    // function agar tidak ada data dobel di slot waktu booking
    public function getAvailableTimeSlots(Request $request)
    {
        $tanggal_booking = $request->input('tanggal_booking');
        $id_layanan = $request->input('id_layanan');

        // Dapatkan slot waktu yang sudah diterima pada tanggal dan layanan tertentu
        $bookedSlots = BookingKlinik::where('tanggal_booking', $tanggal_booking)
                                    ->where('id_layanan', $id_layanan)
                                    ->where('status', 'DITERIMA')
                                    ->pluck('time_slot_id')
                                    ->toArray();

        // Dapatkan semua slot waktu yang tersedia yang belum dibooking
        $availableSlots = TimeSlot::whereNotIn('id', $bookedSlots)->get();

        return response()->json($availableSlots);
    }

    // function filter
    public function filterBookings(Request $request)
    {
        $status = $request->input('status');
        $layananId = $request->input('layanan_id');
        $sort = $request->input('sort', 'desc'); // default descending order

        $cabangs = CabangKlinik::all();
        $dokters = DokterKlinik::all();
        $layanans = Layanan::all();
        $timeSlots = TimeSlot::all();

        $bookings = BookingKlinik::with(['cabangKlinik', 'dokterKlinik', 'layanans', 'timeSlot'])
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($layananId, function ($query, $layananId) {
                return $query->where('id_layanan', $layananId);
            })
            ->orderBy('tanggal_booking', $sort)
            ->paginate(5)
            ->withQueryString();

        // Jika kedua filter digunakan bersamaan, pastikan query menyesuaikan
        if ($status && $layananId) {
            $bookings->where('status', $status)
                    ->where('id_layanan', $layananId);
        }

        return view('auth.pages.booking-status', compact('bookings', 'cabangs', 'dokters', 'timeSlots', 'layanans'));
    }



}
