{{-- ===== LIST PRODUK ===== --}}
@extends('components.layouts.front.app', ['title' => 'List Produk Tefa'])

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
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
        }

        .produk-hero p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
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

        /* Filter */
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

        /* Produk Card */
        .produk-card {
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

        .produk-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(83, 74, 183, 0.13);
        }

        .produk-img-wrap {
            position: relative;
            overflow: hidden;
            height: 210px;
        }

        .produk-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
            display: block;
        }

        .produk-card:hover .produk-img-wrap img {
            transform: scale(1.06);
        }

        .produk-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(30, 10, 60, 0.5) 0%, transparent 55%);
            pointer-events: none;
        }

        .produk-cat-badge {
            position: absolute;
            top: 14px;
            left: 0;
            background: rgba(83, 74, 183, 0.88);
            backdrop-filter: blur(6px);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.4px;
            padding: 4px 14px 4px 12px;
            border-radius: 0 50px 50px 0;
        }

        .produk-body {
            padding: 16px 18px 10px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .produk-title {
            font-size: 13.5px;
            font-weight: 700;
            color: #1e1440;
            line-height: 1.4;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.2s;
        }

        .produk-title:hover {
            color: rgb(175, 140, 226);
        }

        .produk-price {
            font-size: 16px;
            font-weight: 800;
            color: #534AB7;
            margin-top: auto;
            margin-bottom: 8px;
        }

        .produk-meta {
            font-size: 11px;
            color: #aaa;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .produk-meta i {
            color: rgb(175, 140, 226);
            font-size: 12px;
        }

        .produk-footer {
            padding: 10px 18px 16px;
            border-top: 1px solid rgba(175, 140, 226, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .produk-detail-btn {
            font-size: 11px;
            font-weight: 700;
            color: rgb(175, 140, 226);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.2s, color 0.2s;
        }

        .produk-detail-btn:hover {
            gap: 8px;
            color: #534AB7;
        }

        .section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            color: rgb(175, 140, 226);
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e1440;
            margin-bottom: 0;
        }

        .section-line {
            width: 40px;
            height: 3px;
            background: rgb(175, 140, 226);
            border-radius: 2px;
            margin-top: 10px;
        }

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
    <div class="produk-hero">
        <div class="container">
            <p class="produk-hero-label">Koleksi Unggulan</p>
            <h1><i class="bi bi-bag me-2" style="color:rgba(175,140,226,0.8);"></i>Produk</h1>
            <p>Produk terbaik dari Master-T.</p>
        </div>
    </div>

    <div class="produk-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="bi bi-house me-1"></i>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </div>
    </div>

    <div class="container mt-4 mb-5">

        {{-- Filter Bar --}}
        @if (isset($categories) && $categories->count() > 0)
            <div class="filter-bar" data-aos="fade-up">
                <span class="filter-bar-label"><i class="bi bi-funnel me-1"></i>Filter:</span>
                <a href="{{ route('produk') }}" class="filter-chip {{ !request('category') ? 'active' : '' }}">
                    <i class="bi bi-grid-3x3-gap-fill"></i> Semua
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('produk', ['category' => $cat->slug]) }}"
                        class="filter-chip {{ request('category') == $cat->slug ? 'active' : '' }}">
                        {{ $cat->name }}
                        <span
                            style="background:rgba(175,140,226,0.2);color:#534AB7;font-size:10px;padding:1px 7px;border-radius:50px;">
                            {{ $cat->produks_count ?? 0 }}
                        </span>
                    </a>
                @endforeach
            </div>
        @endif

        <div class="row g-3">
            @forelse ($produks as $produk)
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ ($loop->iteration % 3) * 80 }}">
                    <div class="produk-card">
                        <div class="produk-img-wrap">
                            <img src="{{ asset('storage/assets/back/img/produk/' . $produk->image) }}"
                                alt="{{ $produk->title }}">
                            <div class="produk-img-overlay"></div>
                            <span class="produk-cat-badge">
                                <i class="bi bi-tag-fill me-1"></i>{{ $produk->category->name ?? 'Produk' }}
                            </span>
                        </div>
                        <div class="produk-body">
                            <a href="{{ route('show.produk', $produk->slug) }}" class="produk-title">
                                {{ Str::limit($produk->title, 45) }}
                            </a>
                            <div class="produk-price">Rp {{ number_format($produk->price, 0, ',', '.') }}</div>
                            <span class="produk-meta">
                                <i class="bi bi-person-circle"></i>{{ $produk->user->asal_sekolah ?? 'Admin' }}
                            </span>
                        </div>
                        <div class="produk-footer">
                            <span class="produk-meta">
                                <i class="bi bi-calendar3"></i>{{ $produk->created_at->diffForHumans() }}
                            </span>
                            <a href="{{ route('show.produk', $produk->slug) }}" class="produk-detail-btn">
                                Detail <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5" style="color:#ccc;">
                        <i class="bi bi-bag" style="font-size:3.5rem;display:block;margin-bottom:14px;"></i>
                        <p style="font-size:14px;color:#bbb;margin:0;">Belum ada produk yang tersedia</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($produks instanceof \Illuminate\Pagination\LengthAwarePaginator && $produks->hasPages())
            <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                {{ $produks->links() }}
            </div>
        @endif
    </div>

@endsection
