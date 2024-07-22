<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DokterKlinik;
use App\Models\CabangKlinik;

class DokterKlinikController extends Controller
{
    public function index()
    {
        $dokters = DokterKlinik::with('cabangKlinik')->get();
        $cabangs = CabangKlinik::all();
        return view('auth.pages.dokter_klinik', compact('dokters', 'cabangs'));
    }

    public function getDoktersByCabang($id_cabang_klinik)
    {
        $dokters = DokterKlinik::where('id_cabang_klinik', $id_cabang_klinik)->get();
        return response()->json($dokters);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'id_cabang_klinik' => 'required|exists:cabang_klinik,id_cabang_klinik',
        ]);

        DokterKlinik::create($request->all());

        return redirect()->back()->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function update(Request $request, $id_dokter)
    {
        $request->validate([
            'nama_dokter' => 'required|string|max:255',
            'id_cabang_klinik' => 'required|exists:cabang_klinik,id_cabang_klinik',
        ]);

        $dokter = DokterKlinik::findOrFail($id_dokter);
        $dokter->update($request->all());

        return redirect()->back()->with('success', 'Dokter berhasil diupdate!');
    }

    public function destroy($id_dokter)
    {
        $dokter = DokterKlinik::findOrFail($id_dokter);
        $dokter->delete();

        return redirect()->back()->with('success', 'Dokter berhasil dihapus!');
    }
}
