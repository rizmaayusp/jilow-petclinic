<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Kategori; // Pastikan untuk mengimport model Kategori

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::with('kategori')->get();
        $categories = Kategori::all(); // Mengambil semua data kategori
        return view('auth.pages.layanan_kami', compact('layanans', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar_layanan' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_layanan' => 'required|string|max:255',
            'kategori_id' => 'required|integer|exists:kategori,id_kategori', // Perbaikan pada exists:categories
            'deskripsi_layanan' => 'required|string',
        ]);

        $imageName = null;
        if ($request->hasFile('gambar_layanan')) {
            $image = $request->file('gambar_layanan');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        Layanan::create([
            'gambar_layanan' => $imageName,
            'nama_layanan' => $request->nama_layanan,
            'kategori_id' => $request->kategori_id,
            'deskripsi_layanan' => $request->deskripsi_layanan,
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar_layanan' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_layanan' => 'required|string|max:255',
            'kategori_id' => 'required|integer|exists:kategori,id_kategori', // Perbaikan pada exists:kategori,id_kategori
            'deskripsi_layanan' => 'required|string',
        ]);

        $layanan = Layanan::findOrFail($id);

        $imageName = $layanan->gambar_layanan;
        if ($request->hasFile('gambar_layanan')) {
            $image = $request->file('gambar_layanan');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            if ($layanan->gambar_layanan) {
                $filePath = public_path('images') . '/' . $layanan->gambar_layanan;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $layanan->update([
            'gambar_layanan' => $imageName,
            'nama_layanan' => $request->nama_layanan,
            'kategori_id' => $request->kategori_id,
            'deskripsi_layanan' => $request->deskripsi_layanan,
        ]);

        return redirect()->back()->with('success', 'Layanan berhasil diupdate!');
    }


    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        if ($layanan->gambar_layanan) {
            $filePath = public_path('images') . '/' . $layanan->gambar_layanan;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        $layanan->delete();

        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }
}

