<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CabangKlinik;

class CabangKlinikController extends Controller
{
    public function index()
    {
        $cabangs = CabangKlinik::with('dokterKlinik')->get();
        return view('auth.pages.cabang_klinik', compact('cabangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_cabang' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
        ]);

        CabangKlinik::create([
            'nama_cabang' => $request->nama_cabang,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->back()->with('success', 'Cabang Klinik berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $cabang = CabangKlinik::findOrFail($id);
        $cabang->delete();

        return redirect()->back()->with('success', 'Cabang Klinik berhasil dihapus!');
    }
}

