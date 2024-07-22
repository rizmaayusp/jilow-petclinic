@extends('welcome')

@section('title', 'Testimoni')

@section('content')
<div class="container-testimoni" style="background-color: #FEFBF6; width: 85%; margin: auto; border-radius: 30px">
    <div class="testimonial-header" style="margin-top: 100px">
        <p class="judul-testimoni" style="font-size: 25px; color: #FF8502; font-weight: bolder; letter-spacing: 15px; margin-bottom: 30px">TESTIMONI</p>
        <h2 style="margin-bottom: 30px">Lihat Apa Kata Pemilik Hewan Peliharaan</h2>
        <h3>Tentang Layanan Kami di Jilow Petclinic</h3>
        <p class="deskripsi-testimoni" style="margin-bottom: 70px; color: #fd9800; font-weight: 300">Join 3000+ designers and learn from the best professionals of the world</p>
    </div>
    <div class="row">
        @foreach ($testimoni as $item)
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
    </div>
</div>
@endsection
