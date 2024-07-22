@extends('welcome')

@section('title', 'Tentang Kami')

@section('content')
{{-- section 1 tentang kami --}}
<section class="tentang-kami-1" style="color: black; margin-bottom: 20px; box-shadow: 5px 10px 20px 5px rgba(0, 0, 0, 0.25);">
    <div class="container mt-5" style="padding: 30px 0">
        <div class="row" style="display: flex; align-items: center">
            <div class="col-md-6 mb-4">
                <div class="p-4 no-border">
                    <h1 style="margin-bottom: 30px">Tentang Kami</h1>
                    <p>Kami adalah tim yang berdedikasi untuk memberikan layanan terbaik bagi hewan peliharaan Anda. Dengan pengalaman bertahun-tahun di bidang kesehatan hewan, kami berkomitmen untuk memberikan perawatan yang penuh kasih dan profesional.</p>
                    <p>Visi kami adalah menciptakan dunia di mana semua hewan peliharaan mendapatkan perawatan yang mereka butuhkan dan layak mereka terima.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
                <div class="card no-border" style="border-radius: 30px">
                    <img src="images/tentang-kami/tentang-kami.png" class="card-img-top" alt="Gambar Misi Kami">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2 TENTANG KAMI --}}
<section class="tentang-kami-2">
    <div class="container mt-5" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card" style="border-radius: 30px; border: none; overflow: hidden">
                    <img src="images/tentang-kami/tentang-kami-2.png" style="width: 370px; height: 370px; border-radius: 30px; margin: auto" class="card-img-top" alt="Gambar Misi Kami">
                </div>
            </div>
            <div class="col-md-6 mb-4" >
                <div class="p-4 no-border">
                    <h2 style="margin-bottom: 10px; font-family:'Times New Roman', Times, serif">Mengapa Memilih Kami?</h2>
                    <p style="font-size: 15px; line-height: 2; text-align: justify">Kami berkomitmen untuk memberikan layanan terbaik dengan harga terjangkau. Layanan kami dirancang untuk memberikan kemudahan dan kenyamanan, membuat Anda tidak perlu khawatir tentang kesehatan dan kesejahteraan hewan kesayangan Anda. Pilihlah kami untuk pelayanan yang mudah, cepat, dan berkualitas.</p>
                    <div class="check-list">
                        <i class="bi bi-check"> Harga Terjangkau</i>
                        <i class="bi bi-check"> Pelayanan Mudah dan Terbaik</i>
                        <i class="bi bi-check"> Kualitas Terbaik</i>
                        <i class="bi bi-check"> Layanan Responsif</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3 TENTANG KAMI --}}
<section class="tentang-kami-3" style="margin-bottom: 100px">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="images/tentang-kami/tentang-kami-3.png" alt="" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="text-content bg-white p-4" style="border-radius: 30px">
                    <h1 class="text-center">Booking Mudah dan Cepat Tanpa Antri!</h1>
                    <p class="text-center">Nikmati layanan terbaik kami tanpa harus menunggu. Pesan sekarang dan dapatkan perawatan untuk hewan kesayangan Anda dengan cepat dan nyaman di rumah!</p>
                    <a href="/booking" style="text-decoration: none">
                        <button class="btn btn-primary d-block mx-auto">Pesan Sekarang!</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- section 4 tentang kami (our service singkat) --}}
<section class="tentang-kami-4" style="width: 80%; margin: auto">
    <div class="content-judul" style="text-align: center; margin-bottom: 30px">
        <h1 style="color:black; margin-bottom: 30px; font-family: var(--font-title); font-weight:200; font-size: 50px; letter-spacing: 5px">Layanan Kami</h1>
        <img src="images/beranda/jilow-services.png" alt="" style="margin-top: -30px">
        <p style="color:black; line-height: 2.5; margin-bottom: 40px">Jelajahi berbagai layanan kami yang dirancang untuk memberikan perawatan terbaik dan kenyamanan maksimal untuk hewan kesayangan Anda.
        Dengan berbagai layanan yang kami tawarkan, Anda dapat memastikan bahwa hewan peliharaan Anda mendapatkan perawatan yang penuh kasih dan profesional setiap saat!</p>
    </div>
    <div class="container">
        <div id="carouselLayanan" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        @foreach ($layanans->take(3) as $layanan)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card text-center h-100" style="border: none; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);">
                                    <img src="{{ asset('images/' . $layanan->gambar_layanan) }}" class="rounded-circle mx-auto mt-3" alt="Dokter Hewan" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size: 1.25rem; margin-top: 15px; font-weight: bolder; margin-bottom: 10px">{{ $layanan->nama_layanan }}</h5>
                                        <p class="card-text" style="color: #555; font-size: 16px; line-height: 2">{{ $layanan->deskripsi_layanan }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselLayanan" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselLayanan" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <a href="/layanan" style="text-decoration: none;">
            <button class="btn btn-primary d-block mx-auto">Muat Lebih Banyak</button>
        </a>
    </div>
</section>
@endsection
