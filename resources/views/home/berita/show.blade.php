@extends('components.layouts.front.app', ['title' => 'Detail Berita Tefa'])

@push('styles')
    <style>
        /* Hero & Breadcrumb sama dengan list */
        .berita-hero {
            background: linear-gradient(135deg, #1a0533 0%, #2d1060 50%, #0f2a4a 100%);
            padding: 100px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .berita-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 70% 50%, rgba(175, 140, 226, 0.15) 0%, transparent 65%);
            pointer-events: none;
        }

        .berita-hero-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            color: rgba(175, 140, 226, 0.9);
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .berita-hero h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .berita-hero p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 13px;
            margin: 0;
        }

        .berita-breadcrumb {
            background: #fff;
            border-bottom: 1px solid rgba(175, 140, 226, 0.12);
            padding: 12px 0;
        }

        .berita-breadcrumb .breadcrumb {
            margin: 0;
            background: none;
            font-size: 12px;
            padding: 0;
        }

        .berita-breadcrumb .breadcrumb-item a {
            color: rgb(175, 140, 226);
            text-decoration: none;
            font-weight: 600;
        }

        .berita-breadcrumb .breadcrumb-item.active {
            color: #aaa;
        }

        .berita-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
            color: #ddd;
        }

        /* ===== ARTICLE CARD ===== */
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

        /* ===== BERITA TERKAIT ===== */
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

        .terkait-card img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            transition: transform 0.35s;
        }

        .terkait-card:hover img {
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

        .terkait-card-date {
            font-size: 10px;
            color: #bbb;
            margin-top: 6px;
        }

        /* ===== SIDEBAR ===== */
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

        .sidebar-news-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid rgba(175, 140, 226, 0.08);
            text-decoration: none;
        }

        .sidebar-news-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .sidebar-news-img {
            width: 64px;
            height: 52px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
            transition: opacity 0.2s;
        }

        .sidebar-news-item:hover .sidebar-news-img {
            opacity: 0.85;
        }

        .sidebar-news-title {
            font-size: 12px;
            font-weight: 700;
            color: #1e1440;
            line-height: 1.4;
            margin-bottom: 4px;
            transition: color 0.2s;
        }

        .sidebar-news-item:hover .sidebar-news-title {
            color: rgb(175, 140, 226);
        }

        .sidebar-news-date {
            font-size: 10px;
            color: #bbb;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .sidebar-news-date i {
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
    {{-- Hero --}}
    <div class="berita-hero">
        <div class="container">
            <p class="berita-hero-label">Informasi & Update</p>
            <h1><i class="bi bi-newspaper me-2" style="color:rgba(175,140,226,0.8);"></i>Berita</h1>
            <p>Berita terbaru tentang Master-T.</p>
        </div>
    </div>

    {{-- Breadcrumb --}}
    <div class="berita-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}"><i class="bi bi-house me-1"></i>Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('berita') }}">Berita</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ Str::limit($post->title, 40) }}
                </li>
            </ol>
        </div>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row g-4">

            {{-- Konten Utama --}}
            <div class="col-md-8" data-aos="fade-up">
                <div class="article-card">
                    @if ($post->image)
                        <img src="{{ asset('storage/assets/back/img/berita/' . $post->image) }}" class="article-hero-img"
                            alt="{{ $post->title }}">
                    @endif
                    <div class="article-body">
                        <h1 class="article-title">{{ $post->title }}</h1>
                        <div class="article-meta-bar">
                            <span class="article-meta-item">
                                <i class="bi bi-folder2-open"></i>
                                {{ $post->category->name ?? '-' }}
                            </span>
                            <span class="article-meta-item">
                                <i class="bi bi-calendar3"></i>
                                {{ $post->created_at->format('d M Y') }}
                            </span>
                            <span class="article-meta-item">
                                <i class="bi bi-person-circle"></i>
                                {{ $post->user->name ?? '-' }}
                            </span>
                        </div>
                        <hr class="article-divider">
                        <div class="article-content">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>

                {{-- Berita Terkait --}}
                @if ($beritaTerkait->count() > 0)
                    <div class="terkait-section" data-aos="fade-up">
                        <p class="terkait-title">
                            <i class="bi bi-collection"></i> Berita Terkait
                        </p>
                        <div class="row g-3">
                            @foreach ($beritaTerkait as $terkait)
                                <div class="col-md-4 col-sm-6">
                                    <div class="terkait-card">
                                        <div style="overflow:hidden;">
                                            <img src="{{ asset('storage/assets/back/img/berita/' . $terkait->image) }}"
                                                alt="{{ $terkait->title }}">
                                        </div>
                                        <div class="terkait-card-body">
                                            <a href="{{ route('berita.detail', $terkait->slug) }}"
                                                class="terkait-card-title">
                                                {{ Str::limit($terkait->title, 60) }}
                                            </a>
                                            <p class="terkait-card-date">
                                                <i class="bi bi-calendar3"></i>
                                                {{ $terkait->created_at->format('d M Y') }}
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

                {{-- Berita Terbaru --}}
                <div class="sidebar-box">
                    <p class="sidebar-box-title"><i class="bi bi-clock"></i> Terbaru</p>
                    @foreach ($beritaTerbaru as $baru)
                        <a href="{{ route('berita.detail', $baru->slug) }}" class="sidebar-news-item">
                            <img src="{{ asset('storage/assets/back/img/berita/' . $baru->image) }}"
                                class="sidebar-news-img" alt="{{ $baru->title }}">
                            <div>
                                <p class="sidebar-news-title">{{ Str::limit($baru->title, 55) }}</p>
                                <p class="sidebar-news-date">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $baru->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Kategori --}}
                <div class="sidebar-box">
                    <p class="sidebar-box-title"><i class="bi bi-grid"></i> Kategori</p>
                    @foreach ($categories as $cat)
                        <a href="{{ route('berita', ['category' => $cat->slug]) }}" class="kat-item">
                            <span class="d-flex align-items-center gap-2">
                                <i class="bi bi-grid-3x3-gap-fill"></i>
                                {{ $cat->name }}
                            </span>
                            <span class="kat-count">{{ $cat->posts_count }}</span>
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

@endsection
