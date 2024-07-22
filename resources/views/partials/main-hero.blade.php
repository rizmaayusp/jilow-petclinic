{{-- MAIN HERO CONTENT --}}
<section class="main-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 hero-left">
                <h1>Get Ready with <span style="color: #fc8f3a">Jilow PetClinic!</span></h1>
                <p>Klinik Hewan Terbaik untuk Anda! Mari mulai perawatan hewan bersama Jilow! 🚀</p>
                <p>Pusat layanan untuk semua kebutuhan kesehatan hewan peliharaan Anda!😺✨</p>
            </div>
            <div class="col-md-6 hero-right text-center">
                <img src="images/main-hero/jilow-petcare.png" alt="Jilow PetCare">
            </div>
        </div>
    </div>
</section>

{{-- section kolom bawah main-hero --}}
<section class="bawah-main-hero">
    <div class="row row-cols-1 row-cols-md-4 g-4 px-md-5">
        @foreach($categories as $category)
        <div class="col">
            <div class="card shadow-card-mainhero" style="text-align: center">
                <i class="bi bi-house-heart-fill icon-hover" style="font-size: 3rem; margin: 10px 0"></i>
                <h6>Kategori</h6>
                <div class="card-body" style="text-align: center">
                    <h4 class="card-title" style="font-weight: bold">{{ $category->nama_kategori }}</h4>
                    <p class="card-text">{{ $category->deskripsi_kategori }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

