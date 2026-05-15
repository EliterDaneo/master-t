{{-- ===== DETAIL PRODUK ===== --}}
@extends('components.layouts.front.app', ['title' => 'Detail Produk Tefa'])

@push('styles')
    <style>
        .produk-hero {
            background: linear-gradient(135deg, #1a0533 0%, #2d1060 50%, #0f2a4a 100%);
            padding: 100px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .produk-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 30% 50%, rgba(175, 140, 226, 0.15) 0%, transparent 65%);
            pointer-events: none;
        }

        .produk-hero-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            color: rgba(175, 140, 226, 0.9);
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .produk-hero h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .produk-hero p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 13px;
            margin: 0;
        }

        .produk-breadcrumb {
            background: #fff;
            border-bottom: 1px solid rgba(175, 140, 226, 0.12);
            padding: 12px 0;
        }

        .produk-breadcrumb .breadcrumb {
            margin: 0;
            background: none;
            font-size: 12px;
            padding: 0;
        }

        .produk-breadcrumb .breadcrumb-item a {
            color: rgb(175, 140, 226);
            text-decoration: none;
            font-weight: 600;
        }

        .produk-breadcrumb .breadcrumb-item.active {
            color: #aaa;
        }

        .produk-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
            color: #ddd;
        }

        /* Article */
        .article-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid rgba(175, 140, 226, 0.12);
            box-shadow: 0 4px 24px rgba(83, 74, 183, 0.07);
            overflow: hidden;
        }

        .article-hero-img {
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            display: block;
        }

        .article-body {
            padding: 32px 36px;
        }

        .article-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #1e1440;
            line-height: 1.3;
            margin-bottom: 16px;
        }

        .article-meta-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
            margin-bottom: 20px;
        }

        .article-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #aaa;
        }

        .article-meta-item i {
            color: rgb(175, 140, 226);
            font-size: 13px;
        }

        .article-divider {
            border: none;
            border-top: 1px solid rgba(175, 140, 226, 0.15);
            margin: 20px 0;
        }

        .article-content {
            font-size: 15px;
            color: #444;
            line-height: 1.85;
        }

        .article-content img {
            max-width: 100%;
            border-radius: 10px;
            margin: 12px 0;
        }

        .article-content h1,
        .article-content h2,
        .article-content h3 {
            color: #1e1440;
            font-weight: 700;
            margin-top: 24px;
        }

        .article-content a {
            color: rgb(175, 140, 226);
        }

        .article-content blockquote {
            border-left: 3px solid rgb(175, 140, 226);
            margin: 16px 0;
            padding: 12px 20px;
            background: rgba(175, 140, 226, 0.06);
            border-radius: 0 8px 8px 0;
            color: #666;
            font-style: italic;
        }

        /* WA Banner */
        .wa-banner {
            margin-top: 28px;
            padding: 24px 28px;
            background: linear-gradient(135deg, #f0faf5 0%, #e8f5ee 100%);
            border-radius: 16px;
            border: 1px solid rgba(37, 211, 102, 0.2);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }

        .wa-banner-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #25d366;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .wa-banner-text h6 {
            font-size: 14px;
            font-weight: 700;
            color: #1e1440;
            margin-bottom: 3px;
        }

        .wa-banner-text p {
            font-size: 12px;
            color: #888;
            margin: 0;
        }

        .wa-btn {
            margin-left: auto;
            background: #25d366;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 10px 24px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s, transform 0.2s;
            flex-shrink: 0;
        }

        .wa-btn:hover {
            background: #1ebe5d;
            transform: translateY(-2px);
            color: #fff;
        }

        /* Terkait */
        .terkait-section {
            margin-top: 36px;
        }

        .terkait-title {
            font-size: 15px;
            font-weight: 800;
            color: #1e1440;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .terkait-title i {
            color: rgb(175, 140, 226);
        }

        .terkait-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid rgba(175, 140, 226, 0.1);
            box-shadow: 0 3px 14px rgba(83, 74, 183, 0.05);
            overflow: hidden;
            height: 100%;
            transition: transform 0.22s, box-shadow 0.22s;
        }

        .terkait-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(83, 74, 183, 0.12);
        }

        .terkait-card-img-wrap {
            overflow: hidden;
            height: 130px;
        }

        .terkait-card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.35s;
            display: block;
        }

        .terkait-card:hover .terkait-card-img-wrap img {
            transform: scale(1.05);
        }

        .terkait-card-body {
            padding: 12px 14px;
        }

        .terkait-card-title {
            font-size: 12px;
            font-weight: 700;
            color: #1e1440;
            text-decoration: none;
            line-height: 1.4;
            display: block;
            transition: color 0.2s;
        }

        .terkait-card-title:hover {
            color: rgb(175, 140, 226);
        }

        .terkait-price {
            font-size: 13px;
            font-weight: 800;
            color: #534AB7;
            margin-top: 6px;
        }

        .terkait-date {
            font-size: 10px;
            color: #bbb;
            margin-top: 4px;
        }

        /* Sidebar */
        .sidebar-box {
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(175, 140, 226, 0.12);
            box-shadow: 0 4px 20px rgba(83, 74, 183, 0.06);
            padding: 22px 20px;
            margin-bottom: 24px;
        }

        .sidebar-box-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.5px;
            color: rgb(175, 140, 226);
            text-transform: uppercase;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .sidebar-box-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(175, 140, 226, 0.2);
        }

        .sidebar-wa-card {
            background: linear-gradient(135deg, #0f5c2e 0%, #1a7a40 100%);
            border-radius: 16px;
            padding: 24px 20px;
            margin-bottom: 24px;
            text-align: center;
            border: 1px solid rgba(37, 211, 102, 0.2);
        }

        .sidebar-wa-icon {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .sidebar-wa-title {
            font-size: 15px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 6px;
        }

        .sidebar-wa-desc {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.65);
            margin-bottom: 16px;
        }

        .sidebar-wa-btn {
            background: #25d366;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 10px 24px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s, transform 0.2s;
        }

        .sidebar-wa-btn:hover {
            background: #1ebe5d;
            transform: translateY(-2px);
            color: #fff;
        }

        .sidebar-produk-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid rgba(175, 140, 226, 0.08);
            text-decoration: none;
        }

        .sidebar-produk-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .sidebar-produk-img {
            width: 64px;
            height: 52px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
            transition: opacity 0.2s;
        }

        .sidebar-produk-item:hover .sidebar-produk-img {
            opacity: 0.85;
        }

        .sidebar-produk-title {
            font-size: 12px;
            font-weight: 700;
            color: #1e1440;
            line-height: 1.4;
            margin-bottom: 3px;
            transition: color 0.2s;
        }

        .sidebar-produk-item:hover .sidebar-produk-title {
            color: rgb(175, 140, 226);
        }

        .sidebar-produk-price {
            font-size: 12px;
            font-weight: 800;
            color: #534AB7;
        }

        .sidebar-produk-date {
            font-size: 10px;
            color: #bbb;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 2px;
        }

        .sidebar-produk-date i {
            color: rgb(175, 140, 226);
            font-size: 10px;
        }

        .kat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 9px 13px;
            border-radius: 10px;
            border: 1px solid rgba(175, 140, 226, 0.1);
            margin-bottom: 7px;
            text-decoration: none;
            color: #444;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.22s;
            background: #faf9ff;
        }

        .kat-item:hover {
            background: rgba(175, 140, 226, 0.1);
            border-color: rgba(175, 140, 226, 0.4);
            color: #534AB7;
            transform: translateX(4px);
        }

        .kat-item i {
            color: rgb(175, 140, 226);
            font-size: 13px;
        }

        .kat-count {
            background: rgba(175, 140, 226, 0.15);
            color: #534AB7;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 50px;
        }
    </style>
@endpush

@section('content')

    @php
        $nomorWA = '6281234567890';
        $pesanWA = urlencode(
            "Halo, saya tertarik dengan produk *{$produk->title}* yang saya lihat di website Master-T. Boleh saya mendapatkan informasi lebih lanjut mengenai produk ini?",
        );
    @endphp

    <div class="produk-hero">
        <div class="container">
            <p class="produk-hero-label">Koleksi Unggulan</p>
            <h1><i class="bi bi-box-seam me-2" style="color:rgba(175,140,226,0.8);"></i>Produk</h1>
            <p>Produk unggulan dari Master-T.</p>
        </div>
    </div>

    <div class="produk-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="bi bi-house me-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('produk') }}">Produk</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($produk->title, 40) }}</li>
            </ol>
        </div>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row g-4">

            {{-- Konten Utama --}}
            <div class="col-md-8" data-aos="fade-up">
                <div class="article-card">
                    @if ($produk->image)
                        <img src="{{ asset('storage/assets/back/img/produk/' . $produk->image) }}" class="article-hero-img"
                            alt="{{ $produk->title }}">
                    @endif
                    <div class="article-body">
                        <h1 class="article-title">{{ $produk->title }}</h1>
                        <div class="article-meta-bar">
                            <span class="article-meta-item">
                                <i class="bi bi-folder2-open"></i>{{ $produk->category->name ?? '-' }}
                            </span>
                            <span class="article-meta-item">
                                <i class="bi bi-calendar3"></i>{{ $produk->created_at->format('d M Y') }}
                            </span>
                            <span class="article-meta-item">
                                <i class="bi bi-person-circle"></i>{{ $produk->user->name ?? '-' }}
                            </span>
                            <span class="article-meta-item ms-auto" style="color:#534AB7;font-weight:800;font-size:15px;">
                                Rp {{ number_format($produk->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <hr class="article-divider">
                        <div class="article-content">{!! $produk->content !!}</div>

                        {{-- WA Banner --}}
                        <div class="wa-banner">
                            <div class="wa-banner-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fff"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                </svg>
                            </div>
                            <div class="wa-banner-text">
                                <h6>Tertarik dengan produk ini?</h6>
                                <p>Hubungi kami langsung via WhatsApp untuk informasi & pemesanan.</p>
                            </div>
                            <a href="https://wa.me/{{ $nomorWA }}?text={{ $pesanWA }}" target="_blank"
                                class="wa-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                </svg>
                                Chat via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Produk Terkait --}}
                @if ($produkTerkait->count() > 0)
                    <div class="terkait-section" data-aos="fade-up">
                        <p class="terkait-title"><i class="bi bi-collection"></i> Produk Terkait</p>
                        <div class="row g-3">
                            @foreach ($produkTerkait as $terkait)
                                <div class="col-md-4 col-sm-6">
                                    <div class="terkait-card">
                                        <div class="terkait-card-img-wrap">
                                            <img src="{{ asset('storage/assets/back/img/produk/' . $terkait->image) }}"
                                                alt="{{ $terkait->title }}">
                                        </div>
                                        <div class="terkait-card-body">
                                            <a href="{{ route('show.produk', $terkait->slug) }}"
                                                class="terkait-card-title">
                                                {{ Str::limit($terkait->title, 55) }}
                                            </a>
                                            <p class="terkait-price">Rp {{ number_format($terkait->price, 0, ',', '.') }}
                                            </p>
                                            <p class="terkait-date"><i
                                                    class="bi bi-calendar3 me-1"></i>{{ $terkait->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-md-4" data-aos="fade-left">

                {{-- WA Sidebar Card --}}
                <div class="sidebar-wa-card">
                    <div class="sidebar-wa-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#25d366"
                            viewBox="0 0 16 16">
                            <path
                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                        </svg>
                    </div>
                    <p class="sidebar-wa-title">Tanya Produk Ini</p>
                    <p class="sidebar-wa-desc">Konsultasi gratis, kami siap membantu Anda menemukan produk yang tepat!</p>
                    <a href="https://wa.me/{{ $nomorWA }}?text={{ $pesanWA }}" target="_blank"
                        class="sidebar-wa-btn">
                        <i class="bi bi-chat-dots"></i> Chat Sekarang
                    </a>
                </div>

                {{-- Produk Terbaru --}}
                <div class="sidebar-box">
                    <p class="sidebar-box-title"><i class="bi bi-clock"></i> Terbaru</p>
                    @foreach ($produkTerbaru as $baru)
                        <a href="{{ route('show.produk', $baru->slug) }}" class="sidebar-produk-item">
                            <img src="{{ asset('storage/assets/back/img/produk/' . $baru->image) }}"
                                class="sidebar-produk-img" alt="{{ $baru->title }}">
                            <div>
                                <p class="sidebar-produk-title">{{ Str::limit($baru->title, 50) }}</p>
                                <p class="sidebar-produk-price">Rp {{ number_format($baru->price, 0, ',', '.') }}</p>
                                <p class="sidebar-produk-date">
                                    <i class="bi bi-calendar3"></i>{{ $baru->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Kategori --}}
                <div class="sidebar-box">
                    <p class="sidebar-box-title"><i class="bi bi-grid"></i> Kategori</p>
                    @foreach ($categories as $cat)
                        <a href="{{ route('produk', ['category' => $cat->slug]) }}" class="kat-item">
                            <span class="d-flex align-items-center gap-2">
                                <i class="bi bi-grid-3x3-gap-fill"></i>{{ $cat->name }}
                            </span>
                            <span class="kat-count">{{ $cat->produks_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
