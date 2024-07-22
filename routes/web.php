<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\KategoriController; // kategori
use App\Http\Controllers\Auth\BlogController; // blog
use App\Http\Controllers\Auth\LayananController; // layanan
use App\Http\Controllers\Auth\EmailNewsletterController; // subscribe email
use App\Http\Controllers\Auth\CabangKlinikController; // cabang klinik
use App\Http\Controllers\Auth\DokterKlinikController; // dokter klinik
use App\Http\Controllers\Auth\BookingController; // booking klinik
use App\Http\Controllers\Auth\AdminController; // untuk mengontrol status booking pelanggan
use App\Http\Controllers\Auth\TestimoniController; // testimoni
use App\Http\Controllers\Auth\NomorAntrianController; // nomor antrian
use App\Http\Controllers\Auth\TimeSlotController; // time slot
use App\Http\Controllers\Auth\PasswordController; // ubah password

use App\Http\Controllers\MainController; // Main frontend user

// Routes Admin
Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

Route::middleware(['auth'])->group(function () {
    // dashboard admin welcome
    Route::get('admin-dashboard', [AuthController::class, 'showDashboard'])->name("admin.dashboard");

    // CHART DASHBOARD
    Route::get('/admin/bookings/data-per-day', [BookingController::class, 'getBookingDataPerDay'])->name('admin.bookings.data-per-day');
    Route::get('/admin/bookings/data-by-status', [BookingController::class, 'getBookingDataByStatus'])->name('admin.bookings.data-by-status');

    // profile
    Route::get('admin-profile', [AuthController::class, 'showProfile'])->name("admin.profile");

    // ubah password
    Route::get('admin/password/change', [PasswordController::class, 'showChangePasswordForm'])->name('admin.password.change');
    Route::post('admin/password/change', [PasswordController::class, 'changePassword'])->name('admin.password.update');

    // Kategori
    Route::get('admin/kategori', [KategoriController::class, 'showCategories'])->name('admin.kategori.index');
    Route::post('admin/kategori/store', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::post('admin/kategori/update/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('admin/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.delete');

    // Blog
    Route::get('admin/blog', [BlogController::class, 'showBlogs'])->name('admin.blog.index');
    Route::post('admin/blog/store', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::put('admin/blog/update/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('admin/blog/delete/{id}', [BlogController::class, 'destroy'])->name('admin.blog.delete');

    // Layanan
    Route::get('admin/layanan', [LayananController::class, 'index'])->name('admin.layanan.index');
    Route::post('admin/layanan/store', [LayananController::class, 'store'])->name('admin.layanan.store');
    Route::put('admin/layanan/update/{id}', [LayananController::class, 'update'])->name('admin.layanan.update');
    Route::delete('admin/layanan/delete/{id}', [LayananController::class, 'destroy'])->name('admin.layanan.delete');

    // Email Newsletter
    Route::get('/admin/email-newsletter', [EmailNewsletterController::class, 'index'])->name('admin.email-newsletter.index');
    Route::post('/admin/email-newsletter', [EmailNewsletterController::class, 'store'])->name('admin.email-newsletter.store');
    Route::delete('/admin/email-newsletter/{id}', [EmailNewsletterController::class, 'destroy'])->name('admin.email-newsletter.destroy');

    // Cabang Klinik
    Route::get('admin/cabang-klinik', [CabangKlinikController::class, 'index'])->name('admin.cabang-klinik.index');
    Route::post('admin/cabang-klinik', [CabangKlinikController::class, 'store'])->name('admin.cabang-klinik.store');
    Route::delete('admin/cabang-klinik/{id}', [CabangKlinikController::class, 'destroy'])->name('admin.cabang-klinik.destroy');

    // Dokter Klinik
    Route::get('/get-dokters/{id_cabang_klinik}', [DokterKlinikController::class, 'getDoktersByCabang']);
    Route::get('admin/dokter-klinik', [DokterKlinikController::class, 'index'])->name('admin.dokter-klinik.index');
    Route::post('admin/dokter-klinik', [DokterKlinikController::class, 'store'])->name('admin.dokter-klinik.store');
    Route::put('admin/dokter-klinik/{id_dokter}', [DokterKlinikController::class, 'update'])->name('admin.dokter-klinik.update');
    Route::delete('admin/dokter-klinik/{id_dokter}', [DokterKlinikController::class, 'destroy'])->name('admin.dokter-klinik.destroy');

    // booking klinik
    Route::get('/admin/bookings', [BookingController::class, 'showBookings'])->name('admin.bookings');
    Route::get('/get-dokters/{id_dokter}', [BookingController::class, 'getDokters']);
    Route::post('/submit-booking', [BookingController::class, 'submitBooking'])->name('submitBooking');
    Route::post('/admin/update-status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::patch('admin/bookings/{id}/update-status', [BookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');

    // CRUD booking
    Route::post('/admin/add-booking', [BookingController::class, 'addBooking'])->name('admin.addBooking');
    Route::post('/admin/update-booking/{id}', [BookingController::class, 'updateBooking'])->name('admin.updateBooking');
    Route::delete('/admin/delete-booking/{id}', [BookingController::class, 'deleteBooking'])->name('admin.deleteBooking');

    // filter booking
    Route::get('/bookings/filter', [BookingController::class, 'filterBookings'])->name('bookings.filter');

    // filter per bulan tiap layanan dalam tiap tahun (tahun dropdown)
    Route::get('/admin/bookings/data-by-service-per-month', [BookingController::class, 'getBookingDataByServicePerMonth'])->name('admin.bookings.data-by-service-per-month');

    // chart filter tiap layanan per bulan (dropdown layanan)
    Route::get('/bookings/data', [BookingController::class, 'getBookingData'])->name('admin.bookings.data');

    // testimoni
    Route::get('admin/testimoni', [TestimoniController::class, 'index'])->name('admin.testimoni.index');
    Route::post('admin/testimoni', [TestimoniController::class, 'store'])->name('admin.testimoni.store');
    Route::put('admin/testimoni/{id}', [TestimoniController::class, 'update'])->name('admin.testimoni.update');
    Route::delete('admin/testimoni/{id}', [TestimoniController::class, 'destroy'])->name('admin.testimoni.destroy');

    // time slot
    Route::get('/time-slots', [TimeSlotController::class, 'index'])->name('time-slots.index');
    Route::get('/time-slots/create', [TimeSlotController::class, 'create'])->name('time-slots.create');
    Route::post('/time-slots', [TimeSlotController::class, 'store'])->name('time-slots.store');
    Route::delete('/time-slots/{id}', [TimeSlotController::class, 'destroy'])->name('time-slots.destroy');

    // recap booking
    Route::get('/rekap-booking', [BookingController::class, 'rekapHarian'])->name('rekap.booking');


    // route agar tidak ada data yang dobel saat booking
    Route::get('/available-time-slots', [BookingController::class, 'getAvailableTimeSlots']);

    // test kirim email
    Route::get('/send-test-email', [TestEmailController::class, 'sendTestEmail']);

    // logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/admin/login');
    })->name('logout');
});

// Rute untuk frontend
Route::get('/beranda', [MainController::class, 'showBeranda'])->name('frontend.beranda.show');
Route::get('/tentang-kami', [MainController::class, 'showTentangKami'])->name('frontend.tentangkami.show');
Route::get('/layanan', [MainController::class, 'showLayanan'])->name('frontend.layanan.show');
Route::get('/testimoni', [MainController::class, 'showTestimoni'])->name('frontend.testimoni.show');
Route::get('/booking', [MainController::class, 'showBooking'])->name('frontend.booking.show');
Route::get('/blog', [MainController::class, 'showBlog'])->name('frontend.blog.show');


