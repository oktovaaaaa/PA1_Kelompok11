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

        /* Hide the header auth container on mobile by default to keep top header clean and beautiful */
        #header .container-fluid > div:last-child {
            display: none !important;
        }
    }

    /* Failsafe to allow mobile navigation sidebar to display correctly without parent container clipping */
    body.mobile-nav-active #header {
        position: fixed !important;
        inset: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        max-width: 100vw !important;
        margin: 0 !important;
        border-radius: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
    }

    body.mobile-nav-active #header .container-fluid {
        align-items: flex-start !important;
        padding-top: 15px !important;
    }

    /* --- ULTRA-PREMIUM RIGHT-ALIGNED GLASSMORPHIC DRAWER --- */
    
    /* 1. Full-screen transparent backdrop overlay with blur */
    body.mobile-nav-active .navmenu {
        position: fixed !important;
        inset: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(8, 18, 36, 0.5) !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
        display: block !important;
        z-index: 99999 !important;
        transition: all 0.4s ease !important;
    }

    /* 2. Style the ul list to be a premium, right-aligned slide-out drawer panel */
    body.mobile-nav-active .navmenu > ul {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-end !important; /* Align children (links) to the right! */
        justify-content: flex-start !important;
        position: fixed !important;
        top: 0 !important;
        bottom: 0 !important;
        right: 0 !important;
        left: auto !important; /* SNAP TO THE RIGHT (cancels left positioning from main.css) */
        width: 290px !important; /* Beautiful premium sidebar drawer width */
        height: 100vh !important;
        background: linear-gradient(180deg, rgba(11, 22, 44, 0.96) 0%, rgba(18, 38, 72, 0.96) 100%) !important;
        backdrop-filter: blur(25px) !important;
        -webkit-backdrop-filter: blur(25px) !important;
        border-left: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: -10px 0 40px rgba(0, 0, 0, 0.4) !important;
        padding: 90px 25px 120px 25px !important;
        margin: 0 !important;
        overflow-y: auto !important;
        gap: 12px !important; /* Elegant compact spacing */
        z-index: 100000 !important;
        animation: drawerSlideIn 0.35s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }

    @keyframes drawerSlideIn {
        from {
            transform: translateX(100%);
        }
        to {
            transform: translateX(0);
        }
    }

    /* 3. Style the list items and their link anchors to be right-aligned */
    body.mobile-nav-active .navmenu > ul li {
        width: 100% !important;
        text-align: right !important; /* Aligned to the right! */
        opacity: 0;
        animation: mobileNavSlideInRight 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        border-bottom: 1px solid rgba(255, 255, 255, 0.07) !important; /* Thin elegant divider line */
        padding-bottom: 8px !important;
        margin-bottom: 4px !important;
    }

    body.mobile-nav-active .navmenu > ul li:last-child {
        border-bottom: none !important; /* No divider line for the last item */
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
    }

    /* Staggered animation for menu items sliding in from right */
    body.mobile-nav-active .navmenu > ul li:nth-child(1) { animation-delay: 0.05s; }
    body.mobile-nav-active .navmenu > ul li:nth-child(2) { animation-delay: 0.1s; }
    body.mobile-nav-active .navmenu > ul li:nth-child(3) { animation-delay: 0.15s; }
    body.mobile-nav-active .navmenu > ul li:nth-child(4) { animation-delay: 0.2s; }
    body.mobile-nav-active .navmenu > ul li:nth-child(5) { animation-delay: 0.25s; }
    body.mobile-nav-active .navmenu > ul li:nth-child(6) { animation-delay: 0.3s; }
    body.mobile-nav-active .navmenu > ul li:nth-child(7) { animation-delay: 0.35s; }
    body.mobile-nav-active .navmenu > ul li:nth-child(8) { animation-delay: 0.4s; }
    body.mobile-nav-active .navmenu > ul li:nth-child(9) { animation-delay: 0.45s; }
    body.mobile-nav-active .navmenu > ul li:nth-child(10) { animation-delay: 0.5s; }

    @keyframes mobileNavSlideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    body.mobile-nav-active .navmenu > ul li a {
        font-family: 'Poppins', sans-serif !important;
        color: rgba(255, 255, 255, 0.85) !important;
        font-size: 1.1rem !important; /* Clean premium sidebar font size */
        font-weight: 500 !important;
        letter-spacing: 0.5px !important;
        padding: 8px 0 !important; /* Perfect clickable spacing */
        display: block !important;
        transition: all 0.25s ease !important;
        text-align: right !important;
        background: transparent !important; /* Reset any background styles */
        border: none !important;
        box-shadow: none !important;
    }

    /* 4. Active & Hover menu link style: NO background, NO borders, just elegant glowing text! */
    body.mobile-nav-active .navmenu > ul li.active a,
    body.mobile-nav-active .navmenu > ul li a:hover {
        color: #3b82f6 !important; /* Clean glowing blue on active/hover */
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        transform: translateX(-4px) !important; /* Subtle premium slide-left indicator */
    }

    /* 5. Mobile Toggle (X / Close button) positioned at the top-right inside the drawer */
    body.mobile-nav-active .mobile-nav-toggle {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.1) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        width: 44px !important;
        height: 44px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 22px !important;
        top: 25px !important;
        right: 25px !important; /* Placed exactly inside the drawer top-right! */
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2) !important;
        transition: all 0.3s ease !important;
        z-index: 100000000 !important; /* Floats above everything */
        position: fixed !important;
    }

    body.mobile-nav-active .mobile-nav-toggle:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        transform: rotate(90deg) !important;
    }

    /* 6. Align auth CTA button perfectly at the bottom of the right drawer (Zero Overlaps!) */
    body.mobile-nav-active #header .container-fluid > div:last-child {
        position: fixed !important;
        bottom: 40px !important;
        right: 25px !important; /* Constrained inside the 290px drawer */
        width: 240px !important; /* Fits perfectly with 25px margins */
        display: flex !important;
        justify-content: center !important;
        z-index: 100000000 !important;
    }

    body.mobile-nav-active #header .container-fluid > div:last-child a {
        width: 100% !important;
        text-align: center !important;
        padding: 10px 0 !important;
        font-size: 0.9rem !important;
        box-shadow: 0 8px 24px rgba(13, 110, 253, 0.3) !important;
    }
</style>
