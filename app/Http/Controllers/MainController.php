<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Blog;
use App\Models\Layanan;
use App\Models\EmailNewsletter;
use App\Models\CabangKlinik;
use App\Models\DokterKlinik;
use App\Models\BookingKlinik;
use App\Models\Testimoni;
use App\Models\TimeSlot;


class MainController extends Controller
{
    public function showBlog()
    {
        $categories = Kategori::all();
        $blog = Blog::all();
        return view('pages.blog', compact(['categories', 'blog'] ));
    }
    public function showTentangKami()
    {
        $categories = Kategori::all();
        $layanans = Layanan::all();
        return view('pages.tentang-kami', compact('categories', 'layanans'));
    }
    public function showLayanan()
    {
        $categories = Kategori::all();
        $layanans = Layanan::with('kategori')->get();
        return view('pages.layanan-kami', compact(['categories', 'layanans']));
    }
    public function showTestimoni()
    {
        $categories = Kategori::all();
        $testimoni = Testimoni::all();
        $layanans = Layanan::all();
        $bookings = BookingKlinik::all();
        return view('pages.testimoni', compact(['categories', 'testimoni', 'layanans', 'bookings']));
    }
    public function showBooking()
    {
        $categories = Kategori::all();
        $layanans = Layanan::with('kategori')->get();
        $cabangs = CabangKlinik::with('dokterKlinik')->get();
        $dokters = DokterKlinik::with('cabangKlinik')->get();
        $bookings = BookingKlinik::with(['cabangKlinik', 'dokterKlinik', 'layanans'])->get();
        $slots = TimeSlot::all();
        return view('pages.booking-klinik', compact(['categories', 'layanans', 'cabangs', 'dokters', 'bookings', 'slots']));
    }
    public function showBeranda()
    {
        $categories = Kategori::all();
        $emails = EmailNewsletter::all();
        $testimoni = Testimoni::all();
        $layanans = Layanan::all();
        $bookings = BookingKlinik::all();
        $dokters = DokterKlinik::all();
        return view('pages.beranda', compact(['categories', 'emails', 'testimoni', 'layanans', 'bookings', 'dokters']));
    }
}
