<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni;
use App\Models\BookingKlinik;
use App\Models\Layanan;


class TestimoniController extends Controller
{
    public function index()
    {
        $testimoni = Testimoni::with(['booking_kliniks', 'layanans'])->get();
        $bookings = BookingKlinik::where('status', 'DITERIMA')->get();
        $layanans = Layanan::all();
        return view('auth.pages.testimoni', compact('testimoni', 'bookings', 'layanans'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_booking' => 'required|exists:booking_kliniks,id_booking',
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'konten' => 'required',
        ]);

        Testimoni::create($request->all());

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_booking' => 'required|exists:booking_kliniks,id_booking',
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'konten' => 'required',
        ]);

        $testimoni = Testimoni::findOrFail($id);
        $testimoni->update($request->all());

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diupdate.');
    }

    public function destroy($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
