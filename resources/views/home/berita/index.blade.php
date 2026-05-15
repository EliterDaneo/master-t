@extends('components.layouts.front.app', ['title' => 'List Berita Tefa'])

@push('styles')
    <style>
        /* ===== HERO HEADER ===== */
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
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .berita-hero p {
            color: rgba(255, 255, 255, 0.55);
            font-size: 14px;
            margin: 0;
        }

        /* ===== BREADCRUMB ===== */
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

        /* ===== FILTER BAR ===== */
        .filter-bar {
            background: #fff;
            border-radius: 14px;
            border: 1px solid rgba(175, 140, 226, 0.15);
            box-shadow: 0 4px 20px rgba(83, 74, 183, 0.06);
            padding: 16px 20px;
            margin-bottom: 28px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        .filter-bar-label {
            font-size: 12px;
            font-weight: 700;
            color: #aaa;
            margin-right: 4px;
            white-space: nowrap;
        }

        .filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border: 1.5px solid rgba(175, 140, 226, 0.25);
            color: #666;
            background: #faf9ff;
            transition: all 0.2s ease;
        }

        .filter-chip:hover,
        .filter-chip.active {
            background: rgba(175, 140, 226, 0.12);
            border-color: rgba(175, 140, 226, 0.5);
            color: #534AB7;
        }

        .filter-chip.active {
            background: rgba(175, 140, 226, 0.18);
            border-color: rgb(175, 140, 226);
        }

        /* ===== BERITA CARD ===== */
        .berita-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(175, 140, 226, 0.12);
            box-shadow: 0 4px 20px rgba(83, 74, 183, 0.06);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .berita-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(83, 74, 183, 0.13);
        }

        .berita-img-wrap {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .berita-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
            display: block;
        }

        .berita-card:hover .berita-img-wrap img {
            transform: scale(1.06);
        }

        .berita-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(30, 10, 60, 0.55) 0%, transparent 60%);
            pointer-events: none;
        }

        .berita-category-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: rgba(175, 140, 226, 0.88);
            backdrop-filter: blur(6px);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 4px 12px;
            border-radius: 50px;
            text-transform: uppercase;
        }

        .berita-body {
            padding: 18px 20px 12px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .berita-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e1440;
            line-height: 1.45;
            margin-bottom: 8px;
            text-decoration: none;
            display: block;
            transition: color 0.2s;
        }

        .berita-title:hover {
            color: rgb(175, 140, 226);
        }

        .berita-excerpt {
            font-size: 12px;
            color: #888;
            line-height: 1.6;
            flex: 1;
        }

        .berita-footer {
            padding: 10px 20px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(175, 140, 226, 0.1);
            margin-top: 12px;
        }

        .berita-meta {
            font-size: 11px;
            color: #aaa;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .berita-meta i {
            font-size: 12px;
            color: rgb(175, 140, 226);
        }

        .berita-read-btn {
            font-size: 11px;
            font-weight: 700;
            color: rgb(175, 140, 226);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.2s, color 0.2s;
        }

        .berita-read-btn:hover {
            gap: 8px;
            color: #534AB7;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #ccc;
        }

        .empty-state i {
            font-size: 3.5rem;
            display: block;
            margin-bottom: 14px;
        }

        .empty-state p {
            font-size: 14px;
            color: #bbb;
            margin: 0;
        }

        /* ===== PAGINATION ===== */
        .pagination .page-link {
            border-radius: 8px !important;
            border: 1px solid rgba(175, 140, 226, 0.2);
            color: #534AB7;
            font-size: 13px;
            font-weight: 600;
            margin: 0 3px;
            padding: 6px 14px;
            transition: all 0.2s;
        }

        .pagination .page-link:hover {
            background: rgba(175, 140, 226, 0.1);
            border-color: rgb(175, 140, 226);
        }

        .pagination .page-item.active .page-link {
            background: rgb(175, 140, 226);
            border-color: rgb(175, 140, 226);
            color: #fff;
        }
    </style>
@endpush

@section('content')
    {{-- Hero Header --}}
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
                <li class="breadcrumb-item active" aria-current="page">Berita</li>
            </ol>
        </div>
    </div>

    <div class="container mt-4 mb-5">

        {{-- Filter Bar Kategori --}}
        @if (isset($categories) && $categories->count() > 0)
            <div class="filter-bar" data-aos="fade-up">
                <span class="filter-bar-label"><i class="bi bi-funnel me-1"></i>Filter:</span>
                <a href="{{ route('berita') }}" class="filter-chip {{ !request('category') ? 'active' : '' }}">
                    <i class="bi bi-grid-3x3-gap-fill"></i> Semua
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('berita', ['category' => $cat->slug]) }}"
                        class="filter-chip {{ request('category') == $cat->slug ? 'active' : '' }}">
                        {{ $cat->name }}
                        <span
                            style="background:rgba(175,140,226,0.2);color:#534AB7;font-size:10px;padding:1px 7px;border-radius:50px;">
                            {{ $cat->posts_count }}
                        </span>
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Grid Berita --}}
        <div class="row g-3">
            @forelse ($beritas as $index)
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ ($loop->iteration % 3) * 80 }}">
                    <div class="berita-card">
                        <div class="berita-img-wrap">
                            <img src="{{ asset('storage/assets/back/img/berita/' . $index->image) }}"
                                alt="{{ $index->title }}">
                            <div class="berita-img-overlay"></div>
                            <span class="berita-category-badge">
                                <i class="bi bi-newspaper me-1"></i> Berita
                            </span>
                        </div>
                        <div class="berita-body">
                            <a href="{{ route('berita.detail', $index->slug) }}" class="berita-title">
                                {{ $index->title }}
                            </a>
                            <p class="berita-excerpt mb-0">
                                {!! Str::limit(strip_tags($index->content), 100, '...') !!}
                            </p>
                        </div>
                        <div class="berita-footer">
                            <div class="d-flex flex-column gap-1">
                                <span class="berita-meta">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $index->created_at->diffForHumans() }}
                                </span>
                                <span class="berita-meta">
                                    <i class="bi bi-person-circle"></i>
                                    {{ $index->user->asal_sekolah ?? 'Admin' }}
                                </span>
                            </div>
                            <a href="{{ route('berita.detail', $index->slug) }}" class="berita-read-btn">
                                Baca <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-newspaper"></i>
                        <p>Belum ada berita yang tersedia</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($beritas instanceof \Illuminate\Pagination\LengthAwarePaginator && $beritas->hasPages())
            <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                {{ $beritas->links() }}
            </div>
        @endif

    </div>

@endsection
