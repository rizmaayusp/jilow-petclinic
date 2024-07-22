<section>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" style="padding: 10px 30px; top: 0px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/navbar/logo-jilow.png" alt="Jilow PetCare">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarScroll">
                <ul class="navbar-nav ms-3">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('beranda') ? 'active' : '' }}" aria-current="page" href="{{ route('frontend.beranda.show')}}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('tentang-kami') ? 'active' : '' }}" href="{{ route('frontend.tentangkami.show')}}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('layanan') ? 'active' : '' }}" href="{{ route('frontend.layanan.show')}}">Layanan Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('blog') ? 'active' : '' }}" href="{{ route('frontend.blog.show')}}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('testimoni') ? 'active' : '' }}" href="{{ route('frontend.testimoni.show')}}">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('booking') ? 'active' : '' }}" href="{{ route('frontend.booking.show')}}">Booking Klinik</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
