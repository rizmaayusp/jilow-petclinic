@extends('welcome')

@section('title', 'Blog')

@section('content')
{{-- PAGE BLOG --}}

<section class="blog-header">
    <div class="judul-header-blog">
        <h1>Inspirasi <span>Blog</span></h1>
        <p>Selamat datang di blog kami! Di sini, kami berbagi informasi terbaru dan tips bermanfaat tentang kesehatan dan perawatan hewan peliharaan. Temukan panduan perawatan sehari-hari, pentingnya vaksinasi, layanan konsultasi, dan kenyamanan pet hotel kami. Dengan bantuan tim dokter hewan profesional, kami berkomitmen untuk memberikan yang terbaik bagi hewan kesayangan Anda. Tetap ikuti blog kami untuk update terbaru dan bergabunglah dengan komunitas pecinta hewan peliharaan lainnya.</p>
    </div>
    <div class="card-blog">
        <div class="row row-cols-1 row-cols-md-3 g-5">
            @foreach ($blog as $blog)
                <div class="col">
                    <!-- Card 1 -->
                    <div class="card h-100">
                        @if($blog->gambar_blog)
                            <img src="{{ asset('images/' . $blog->gambar_blog) }}" class="card-img-top" alt="Gambar Blog" style="object-fit: cover; height: 300px;">
                        @else
                            <span>Tidak ada gambar</span>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="line-height: 2">{{ $blog->judul_blog }}</h5>
                            <p class="card-text" style="line-height: 2">{{ $blog->konten }}</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">{{ $blog->updated_at }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
