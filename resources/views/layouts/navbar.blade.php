<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ url('') }}" class="logo d-flex align-items-center me-auto">
            <h1 class="sitename">Del Cafe</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ url('') }}">Beranda</a>
                </li>
                <li class="{{ request()->is('menu') ? 'active' : '' }}">
                    <a href="{{ route('userr.menu') }}">Menu</a>
                </li>
                <li class="{{ request()->is('jadwal') ? 'active' : '' }}">
                    <a href="{{ route('userr.jadwal') }}">Jadwal</a>
                </li>
                <li class="{{ request()->is('tentang') ? 'active' : '' }}">
                    <a href="{{route('userr.tentang')}}">Tentang</a>
                </li>
                <li class="{{ request()->is('galeri') ? 'active' : '' }}">
                    <a href="{{route('userr.galeri')}}">Galeri</a>
                </li>
                <li class="{{ request()->is('testimoni') ? 'active' : '' }}">
                    <a href="{{ route('testimoni.index') }}">Testimoni</a>
                </li>
                <li class="{{ request()->is('pengumuman') ? 'active' : '' }}">
                    <a href="{{ route('userr.pengumuman') }}">Pengumuman</a>
                </li>
                @auth
                @if (auth()->user()->role == 'user' && auth()->user()->id)
                <li class="{{ request()->is('keranjang') ? 'active' : '' }}">
                    <a href="{{ route('userr.keranjang') }}">Keranjang</a>
                </li>
                <li class="{{ request()->is('riwayat') ? 'active' : '' }}">
                    <a href="{{ route('userr.riwayatPesanan') }}">Riwayat</a>
                </li>
                @endif
                @endauth
                <li class="{{ request()->is('kontak') ? 'active' : '' }}">
                    <a href="{{ route('kontakuserr') }}">Kontak</a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="d-flex align-items-center">
            @auth
                @if(auth()->user()->role == 'user')
                    @php
                        // Get only the first word of the name
                        $fullName = auth()->user()->name;
                        $firstWord = explode(' ', trim($fullName))[0];
                    @endphp
                    <a href="{{ route('profile.edit') }}" class="d-flex align-items-center me-3 text-decoration-none profile-link-nav">
                        @if(auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                            alt="Foto Profil"
                            class="rounded-circle me-2"
                            style="width: 32px; height: 32px; object-fit: cover; aspect-ratio: 1 / 1; border: 1.5px solid rgba(255, 255, 255, 0.4);">
                        @else
                            <img src="{{ asset('assets/img/profil.jpg') }}" alt="Foto Profil Default" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover; border: 1.5px solid rgba(255, 255, 255, 0.4);">
                        @endif
                        <span class="profile-name-text">{{ $firstWord }}</span>
                    </a>
                    <a class="btn-getstarted-custom" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a class="btn-getstarted-custom" href="{{route('menus.tampilan')}}">Dashboard</a>
                @endif
            @else
                <a class="btn-getstarted-custom" href="{{ route('login') }}">Login</a>
            @endauth
        </div>

    </div>
</header>

<style>
    /* Reset and static header styling */
    #header {
        background-color: rgba(40, 58, 90, 0.95) !important; /* Matches theme default header navy */
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
        padding: 15px 0;
    }

    /* Expand inner container max-width to allow more space for menu items in both states */
    #header .container-fluid.container-xl {
        max-width: 1400px !important;
        width: 100% !important;
    }

    /* Floating Capsule Navbar when page is scrolled down! */
    body.scrolled #header {
        background: rgba(14, 34, 56, 0.82) !important; /* Luxury dark navy transparency */
        backdrop-filter: blur(14px) !important;
        -webkit-backdrop-filter: blur(14px) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        max-width: 1350px !important; /* Expanded max-width for plenty of space! */
        width: calc(100% - 40px) !important;
        margin: 20px auto 0 auto !important;
        left: 0 !important;
        right: 0 !important;
        border-radius: 50px !important; /* Clean floating pill shape */
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25) !important;
        padding: 8px 24px !important;
        z-index: 999;
    }

    /* Active page links & compact paddings in all states to accommodate 10 menu items */
    .navmenu a {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 500 !important;
        font-size: 0.88rem !important; /* Make font slightly more compact */
        padding: 8px 12px !important; /* Elegant slightly tighter padding */
        transition: color 0.3s;
    }

    body.scrolled .navmenu a {
        padding: 6px 10px !important; /* Even more compact on scroll */
        font-size: 0.85rem !important;
    }

    /* Profile name link high contrast styling */
    .profile-link-nav {
        color: rgba(255, 255, 255, 0.9) !important;
        transition: all 0.3s;
    }

    .profile-link-nav:hover {
        color: #20c997 !important;
    }

    .profile-name-text {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
    }

    /* Premium style for Auth / Logout button */
    .btn-getstarted-custom {
        background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
        border: none !important;
        color: #ffffff !important;
        padding: 8px 20px !important;
        border-radius: 50px !important;
        font-weight: 600 !important;
        font-size: 0.82rem !important;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25) !important;
        transition: all 0.3s !important;
        text-decoration: none !important;
        display: inline-block;
    }

    .btn-getstarted-custom:hover {
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.45) !important;
        transform: translateY(-1px) !important;
        color: #ffffff !important;
        background: linear-gradient(135deg, #0056b3 0%, #004085 100%) !important;
    }

    /* Mobile Responsive optimizations for floating capsule navbar */
    @media (max-width: 1200px) {
        body.scrolled #header {
            width: calc(100% - 24px) !important;
            margin: 12px auto 0 auto !important;
            padding: 8px 16px !important;
            border-radius: 30px !important;
        }
        
        .profile-name-text {
            display: none !important; /* Hide name on tablet/mobile dropdown to prevent overlap */
        }
    }
</style>
