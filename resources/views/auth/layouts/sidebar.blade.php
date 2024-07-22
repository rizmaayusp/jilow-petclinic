<aside class="main-sidebar sidebar elevation-10" style="background-color: white; color: white">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex justify-content-center">
        <img src="{{ asset('images/navbar/logo-jilow.png') }}" alt="AdminLTE Logo" class="brand-image" style="margin-top: 10px">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

    <!-- Sidebar Menu -->
<nav class="mt-2" style="color: white">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu Utama</li>
        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin-dashboard*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>
        {{-- Profile --}}
        <li class="nav-item">
            <a href="{{ route('admin.profile') }}" class="nav-link {{ Request::is('admin-profile*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-user-circle" aria-hidden="true"></i>
                <p>Profil</p>
            </a>
        </li>
        <!-- kategori -->
        <li class="nav-item">
            <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ Request::is('admin/kategori*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-list-ul"></i>
                <p>Kategori</p>
            </a>
        </li>
        {{-- blog --}}
        <li class="nav-item">
            <a href="{{ route('admin.blog.index') }}" class="nav-link {{ Request::is('admin/blog*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-th" aria-hidden="true"></i>
                <p>Blog</p>
            </a>
        </li>
        {{-- Layanan Kami --}}
        <li class="nav-item">
            <a href="{{ route('admin.layanan.index') }}" class="nav-link {{ Request::is('admin/layanan*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-suitcase" aria-hidden="true"></i>
                <p>Layanan Kami</p>
            </a>
        </li>
        {{-- Subscribe Email --}}
        <li class="nav-item">
            <a href="{{ route('admin.email-newsletter.index') }}" class="nav-link {{ Request::is('admin/email-newsletter*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-envelope-open" aria-hidden="true"></i>
                <p>Email Subscriber User</p>
            </a>
        </li>
        {{-- Cabang Klinik --}}
        <li class="nav-item">
            <a href="{{ route('admin.cabang-klinik.index') }}" class="nav-link {{ Request::is('admin/cabang-klinik*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-window-maximize" aria-hidden="true"></i>
                <p>Cabang Klinik</p>
            </a>
        </li>
        {{-- Dokter Klinik --}}
        <li class="nav-item">
            <a href="{{ route('admin.dokter-klinik.index') }}" class="nav-link {{ Request::is('admin/dokter-klinik*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-user-md" aria-hidden="true"></i>
                <p>Dokter Klinik</p>
            </a>
        </li>
        {{-- Booking Klinik --}}
        <li class="nav-item">
            <a href="{{ route('admin.bookings') }}" class="nav-link {{ Request::is('admin/bookings*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                <p>Daftar Booking</p>
            </a>
        </li>
        {{-- Testimoni --}}
        <li class="nav-item">
            <a href="{{ route('admin.testimoni.index') }}" class="nav-link {{ Request::is('admin/testimoni*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                <p>Testimoni</p>
            </a>
        </li>
        {{-- Slot Waktu --}}
        <li class="nav-item">
            <a href="{{ route('time-slots.index') }}" class="nav-link {{ Request::is('admin/time-slots*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-calendar" aria-hidden="true"></i>
                <p>Slot Waktu</p>
            </a>
        </li>
        {{-- Recap Booking --}}
        <li class="nav-item">
            <a href="{{ route('rekap.booking') }}" class="nav-link {{ Request::is('admin/rekap-booking*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-archive" aria-hidden="true"></i>
                <p>Rekap Booking</p>
            </a>
        </li>
        <!-- Password Change -->
        <li class="nav-item">
            <a href="{{ route('admin.password.change') }}" class="nav-link {{ Request::is('admin/password/change*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-key" aria-hidden="true"></i>
                <p>
                    Ubah Password
                </p>
            </a>
        </li>
        <!-- Logout -->
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link {{ Request::is('admin/logout*') ? 'active' : '' }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fa fa-sign-in" aria-hidden="true"></i>
                <p>
                    Logout
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
