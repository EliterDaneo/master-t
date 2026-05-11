<nav class="navbar navbar-expand-md navbar-light fixed-top"
    style="
        top: 16px;
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 48px);
        max-width: 1200px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 50px;
        border: 1px solid rgba(175, 140, 226, 0.3);
        border-top: 4px solid rgb(175, 140, 226);
        box-shadow: 0 8px 32px rgba(175, 140, 226, 0.15);
        padding: 8px 24px;
        transition: all 0.3s ease;
    "
    data-aos="fade-down">
    <div class="container-fluid px-0">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
            <img src="{{ asset('assets/images/Logo.jpeg') }}" alt="Logo" width="32" height="32"
                class="rounded-circle mr-2" style="border: 2px solid rgb(175,140,226);">
            <span class="font-weight-bold" style="color: #534AB7;"> Master-T</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" style="outline: none;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mx-auto mb-2 mb-md-0">
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 {{ setActive('berita*') }}" href="{{ route('berita') }}"
                        style="border-radius: 50px; font-size: 13px; font-weight: 600; letter-spacing: 0.5px;">
                        <i class="bi bi-newspaper mr-1"></i> BERITA
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 {{ setActive('produk*') }}" href="{{ route('produk') }}"
                        style="border-radius: 50px; font-size: 13px; font-weight: 600; letter-spacing: 0.5px;">
                        <i class="bi bi-clipboard-data mr-1"></i> PRODUK
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 {{ setActive('order') }}" href="{{ route('order') }}"
                        style="border-radius: 50px; font-size: 13px; font-weight: 600; letter-spacing: 0.5px;">
                        <i class="bi bi-cart-plus mr-1"></i> ORDER
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link px-3 py-2 {{ setActive('kontak') }}" href="{{ route('kontak') }}"
                        style="border-radius: 50px; font-size: 13px; font-weight: 600; letter-spacing: 0.5px;">
                        <i class="bi bi-telephone mr-1"></i> KONTAK
                    </a>
                </li>
            </ul>

            {{-- Tombol Login di kanan --}}
            <a href="{{ route('login') }}" class="btn btn-sm px-4 d-none d-md-inline-block"
                style="background: rgb(175,140,226); color: white; border-radius: 50px; font-size: 13px; font-weight: 600; border: none;">
                <i class="bi bi-box-arrow-in-right mr-1"></i> Login
            </a>
        </div>
    </div>
</nav>

{{-- CSS aktif & hover --}}
<style>
    body {
        padding-top: 0 !important;
    }

    {{-- Carousel menutupi penuh dari atas --}} #myCarousel {
        margin-top: 0;
    }

    #myCarousel img {
        height: 100vh;
        object-fit: cover;
        object-position: center;
    }

    {{-- Navbar tetap terlihat di atas hero --}} .navbar {
        top: 16px;
    }

    {{-- Saat scroll, navbar sedikit mengecil --}} .navbar.scrolled {
        top: 8px;
        box-shadow: 0 8px 40px rgba(175, 140, 226, 0.25) !important;
    }
</style>
