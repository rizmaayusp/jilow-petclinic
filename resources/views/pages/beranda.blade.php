@extends('welcome')

@section('title', 'Beranda')

@section('content')
{{-- SECTION 2 DAPATKAN PERAWATAN KESEHATAN --}}
<main class="home-about">
    <aside class="image">
        <img src="images/beranda/main-pet.png" alt="">
    </aside>
    <div class="content">
        <div class="kotak0"></div>
        <h3>Dapatkan Perawatan Kesehatan Hewan Peliharaan Langsung di Rumah Anda!</h3>
        <article>Petcare adalah solusi terbaik untuk perawatan kesehatan hewan peliharaan Anda. Kami menawarkan layanan dokter hewan panggilan ke rumah yang memudahkan Anda dalam memberikan perawatan terbaik bagi hewan kesayangan tanpa perlu repot keluar rumah.</article>
        <a href="/booking">
            <button style="border-radius: 30px; padding: 15px; border: 3px solid #153243">Pesan Sekarang!</button>
        </a>
    </div>
</main>

{{-- SECTION 3 TESTIMONI POP UP --}}
<section class="testimoni-popup">
    <div class="testimoni-atas">
        <h1>Kami Menyediakan <span style="color:#153243">Tim Terbaik</span><br>untuk Kesehatan Hewan Peliharaan</h1>
        <p>Kami berdedikasi untuk memberikan layanan terbaik demi kesehatan dan kesejahteraan hewan peliharaan Anda. <br>Dengan tim ahli yang berpengalaman, kami siap menangani berbagai kebutuhan hewan kesayangan Anda.</p>
    </div>
    <div class="testimoni-bawah">
        <h5 class="testimoni-header"  style="margin-bottom: 30px; color: #ff961d; font-family: 'Lilita One', sans-serif; letter-spacing: 2px">Apa Kata Mereka?</h5>
        <div class="row justify-content-center card-testimoni-popup">
            @foreach ($testimoni->take(3) as $item)
            <div class="col-md-4 mb-4 testimonial-card">
                <div class="card shadow-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->booking_kliniks->nama_user }}</h5>
                        <p class="card-text">{{ $item->layanans->nama_layanan }}</p>
                        <p class="card-text">{{ $item->konten }}</p>
                        <div class="stars">★★★★★</div>
                    </div>
                </div>
            </div>
            @endforeach
            <a href="/testimoni" style="text-decoration: none;">
                <button class="btn d-block mx-auto">Muat Lebih Banyak</button>
            </a>
        </div>
    </div>
</section>

{{-- SECTION 4 DOKTER PROFESIONAL --}}
<section class="dokter-profesional d-flex align-items-center">
    <div class="row w-100">
        <div class="col-md-6 order-md-2 dokter-content">
            <h2>Bertemu dengan <span class="highlight">Dokter Profesional</span> Kami!</h2>
            <div class="container-dokter mt-5">
                <div class="card card-custom shadow-md">
                    <div class="card-body text-center">
                        <h5 class="card-title">Dr. Joseph Cristine</h5>
                        <p class="card-text" style="font-weight: bold">Dokter Spesialis Hewan</p>
                        <p class="card-text">Dr. Joseph Cristine adalah seorang dokter hewan berpengalaman yang berdedikasi untuk kesejahteraan hewan peliharaan Anda. Dengan pengalaman lebih dari 10 tahun, ia ahli dalam memberikan perawatan terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 order-md-1">
            <img src="images/beranda/dokter.png" alt="Gambar Layanan 1">
        </div>
    </div>
</section>

{{-- SECTION 5 SUBSCRIBE EMAIL USER --}}
<div id="subscribe-section" class="subscribe-section">
    <h2>Berlangganan <span style="color: #ff961d">Newsletter Kami!</span></h2>
    <p>Dapatkan berita terbaru terkait perawatan hewan peliharaan langsung di kotak masuk Anda. Kami akan mengirimkan tips, artikel, dan informasi bermanfaat lainnya untuk membantu Anda merawat hewan peliharaan kesayangan Anda.</p>
    <form id="subscribe-form" action="{{ route('admin.email-newsletter.store') }}" method="post">
        @csrf
        <input type="email" name="email" placeholder="Enter your email address..." required>
        <button type="submit" class="btn">Subscribe</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

{{-- pop up section --}}
@if (session('success'))
<section class="popup-card" id="popup">
    <div class="card-1">
        <div class="card_detail" id="cardDetail">
            <h1 id="h3contentDetail">{{ session('success') }}</h1>
            <p style="margin-bottom: 30px; line-height: 2">Terimakasih atas antusiasnya! <br>Kami akan mengirimkan email kepada anda jika ada kabar terbaru. <span style="color: #023047; font-weight:400"><br>Cek secara berkala notifikasi email anda!</span></p>
        </div>
        <div class="detail_btn">
            <a href="#" class="btn">Tutup</a>
        </div>
    </div>
</section>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            window.location.hash = '#popup';
        @endif
    });
</script>

@endsection

