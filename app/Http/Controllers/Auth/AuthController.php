<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\BookingKlinik;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function showDashboard()
    {
        $bookings = BookingKlinik::orderBy('created_at', 'desc')->take(10)->get();
        return view('auth.pages.dashboard', compact('bookings')); //path ke dashboard
    }

    public function showProfile()
    {
        return view('auth.pages.profile'); //path ke page profile
    }

    public function login(Request $request)
    {
        // Validasi data yang diinput
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);



        // Coba melakukan proses login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            // Jika berhasil, redirect ke halaman dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // Jika gagal, kembali ke halaman login dengan pesan kesalahan
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'Email atau password salah.');
    }
}
