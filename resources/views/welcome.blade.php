@extends('components.layouts.front.app', ['title' => 'Selamat Datang di TEFA MUTU'])

@section('content')
    {{-- Slider + Kategori --}}
    <div
        style="background: linear-gradient(135deg, #1a0533 0%, #2d1060 50%, #0f2a4a 100%); padding-top: 100px; padding-bottom: 80px;">
        <div class="container">
            <div class="row align-items-center g-4">

                {{-- Kolom Kategori (col-4) --}}
                <div class="col-md-4" data-aos="fade-right">
                    <div class="mb-4">
                        <small class="text-uppercase fw-bold"
                            style="color: rgb(175,140,226); letter-spacing: 3px; font-size: 11px;">Jelajahi</small>
                        <h3 class="text-white fw-bold mt-1 mb-0" style="font-size: 1.8rem; line-height: 1.2;">
                            Kategori <br>Produk Kami
                        </h3>
                        <div
                            style="width: 40px; height: 3px; background: rgb(175,140,226); margin-top: 12px; border-radius: 2px;">
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        @forelse ($category as $c)
                            <a href="{{ route('produk', ['category' => $c->slug]) }}"
                                class="d-flex justify-content-between align-items-center text-decoration-none px-4 py-3 rounded-pill category-item"
                                style="background: rgba(255,255,255,0.07); border: 1px solid rgba(175,140,226,0.2); color: #fff; transition: all 0.3s ease;">
                                <span class="d-flex align-items-center gap-2" style="font-size: 0.9rem;">
                                    <i class="bi bi-grid-3x3-gap-fill" style="color: rgb(175,140,226);"></i>
                                    {{ $c->name }}
                                </span>
                                <span class="badge rounded-pill px-2 py-1"
                                    style="background: rgba(175,140,226,0.3); color: rgb(210,190,255); font-size: 11px;">
                                    {{ $c->posts_count }}
                                </span>
                            </a>
                        @empty
                            <p class="text-muted small">Belum ada kategori tersedia.</p>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('produk') }}" class="btn px-4 py-2 rounded-pill fw-semibold"
                            style="background: rgb(175,140,226); color: #fff; font-size: 0.85rem; border: none;">
                            <i class="bi bi-box-seam me-1"></i> Lihat Semua Produk
                        </a>
                    </div>
                </div>

                {{-- Kolom Slider (col-8) --}}
                <div class="col-md-8" data-aos="fade-left">
                    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel"
                        style="border-radius: 24px; overflow: hidden; box-shadow: 0 30px 80px rgba(0,0,0,0.5);">

                        <ol class="carousel-indicators" style="margin-bottom: 16px; z-index: 2;">
                            @foreach ($sliders as $index => $s)
                                <li data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}"
                                    class="{{ $loop->first ? 'active' : '' }}"
                                    style="width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.5); border: none;">
                                </li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner" style="border-radius: 24px;">
                            @forelse ($sliders as $s)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="position: relative;">
                                    {{-- Gradient overlay --}}
                                    <div
                                        style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(10,0,30,0.75) 0%, rgba(0,0,0,0.1) 60%, transparent 100%); z-index: 1; pointer-events: none; border-radius: 24px;">
                                    </div>

                                    <img src="{{ asset('storage/assets/back/img/slider/' . $s->image) }}"
                                        alt="{{ $s->title }}" class="w-100"
                                        style="height: 460px; object-fit: cover; object-position: center; display: block;">

                                    @if ($s->title)
                                        <div class="carousel-caption text-start"
                                            style="z-index: 2; bottom: 36px; left: 36px; right: 36px;">
                                            <span class="badge rounded-pill mb-2 px-3 py-2"
                                                style="background: rgba(175,140,226,0.35); color: rgb(210,190,255); font-size: 11px; letter-spacing: 2px; text-transform: uppercase; backdrop-filter: blur(6px);">
                                                TEFA MUTU
                                            </span>
                                            <h4 class="fw-bold text-white mb-0"
                                                style="font-size: 1.5rem; text-shadow: 0 2px 12px rgba(0,0,0,0.4);">
                                                {{ $s->title }}
                                            </h4>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <div class="d-flex align-items-center justify-content-center text-white"
                                        style="height: 460px; background: rgba(255,255,255,0.05);">
                                        <p class="mb-0 text-muted">Belum Ada Slider Yang Tersedia</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev"
                            style="z-index: 2; width: 48px; height: 48px; background: rgba(255,255,255,0.12); border-radius: 50%; top: 50%; transform: translateY(-50%); left: 16px; backdrop-filter: blur(6px);">
                            <span class="carousel-control-prev-icon" style="width: 16px; height: 16px;"></span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next"
                            style="z-index: 2; width: 48px; height: 48px; background: rgba(255,255,255,0.12); border-radius: 50%; top: 50%; transform: translateY(-50%); right: 16px; backdrop-filter: blur(6px);">
                            <span class="carousel-control-next-icon" style="width: 16px; height: 16px;"></span>
                        </a>
                    </div>

                    {{-- Dekorasi bawah slider --}}
                    <div class="d-flex align-items-center gap-2 mt-3 ps-1">
                        <div style="width: 6px; height: 6px; border-radius: 50%; background: rgb(175,140,226);"></div>
                        <small style="color: rgba(255,255,255,0.4); font-size: 11px; letter-spacing: 1px;">
                            Geser untuk melihat lebih banyak
                        </small>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- About: Struktur Organisasi & Visi Misi --}}
    <div class="container mt-5 mb-5" id="about">

        <div class="row mb-4">
            <div class="col-md-12">
                <h4><i class="bi bi-people"></i> STRUKTUR ORGANISASI</h4>
                <hr style="border-top: 3px solid rgb(175,140,226); width: 60px; margin-left: 0;">
            </div>
        </div>

        @php
            $levels = $strukturs->groupBy('position_level')->sortKeys();
        @endphp

        <div class="org-wrapper">
            @forelse ($levels as $level => $members)
                {{-- Level cards --}}
                <div class="org-level" data-aos="fade-up">
                    @foreach ($members->sortBy('order') as $struktur)
                        <div class="org-card {{ $level == $levels->keys()->first() ? 'is-top' : '' }}"
                            style="
                        {{ $level == $levels->keys()->first() ? 'border-top-color:' . $struktur->bg_color . ';' : '' }}
                    ">
                            {{-- Nomor urut kecil --}}
                            <div
                                style="
                        position:absolute; top:10px; right:12px;
                        width:18px; height:18px; border-radius:50%;
                        background:{{ $struktur->bg_color }}22;
                        font-size:9px; font-weight:700;
                        color:{{ $struktur->bg_color }};
                        display:flex; align-items:center; justify-content:center;
                    ">
                                {{ $loop->iteration }}</div>

                            <div class="org-avatar" style="border-color:{{ $struktur->bg_color }};">
                                <img src="{{ asset('storage/assets/back/img/struktur/' . $struktur->image) }}"
                                    alt="{{ $struktur->name }}">
                            </div>

                            <div class="org-name">{{ $struktur->name }}</div>
                            <div class="org-title">{{ $struktur->title }}</div>
                            <span class="org-badge" style="background:{{ $struktur->bg_color }};">
                                {{ $struktur->position_label }}
                            </span>
                        </div>
                    @endforeach
                </div>

                {{-- Garis penghubung antar level --}}
                @if (!$loop->last)
                    @php
                        $nextMembers = $levels->get($levels->keys()[$loop->index + 1]);
                        $nextCount = $nextMembers->count();
                        $hlineWidth = max(($nextCount - 1) * 196, 0);
                    @endphp
                    <div class="org-connector-wrap" data-aos="fade-up">
                        {{-- Garis turun dari level atas --}}
                        <div class="org-vline"></div>

                        @if ($nextCount > 1)
                            {{-- Garis horizontal --}}
                            <div class="org-hline-row">
                                <div class="org-hline-row-inner" style="width:{{ $hlineWidth }}px;"></div>
                            </div>
                            {{-- Garis turun ke tiap card berikutnya --}}
                            <div class="org-vlines-row" style="gap:{{ 196 }}px;">
                                @for ($i = 0; $i < $nextCount; $i++)
                                    <div class="org-vline"></div>
                                @endfor
                            </div>
                        @else
                            <div class="org-vline"></div>
                        @endif
                    </div>
                @endif

            @empty
                <div class="alert alert-danger text-center">
                    Belum Ada Struktur Organisasi Yang Tersedia
                </div>
            @endforelse
        </div>

        {{-- Visi & Misi --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <h4><i class="bi bi-lightbulb" aria-hidden="true"></i> VISI & MISI</h4>
                <hr style="border-top: 3px solid rgb(175,140,226); width: 60px; margin-left: 0;">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-4" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded-lg h-100">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="bi bi-bullseye mr-2" style="color:rgb(175,140,226);"></i> VISI
                        </h5>
                        @forelse ($vms->where('type', 'vision')->where('status', true)->sortBy('order') as $vision)
                            <p class="text-muted">{!! $vision->content !!}</p>
                        @empty
                            <div class="alert alert-danger text-center" role="alert">
                                Belum Ada Visi Yang Tersedia
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-lg h-100">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="bi bi-check mr-2" style="color:rgb(175,140,226);"></i> MISI
                        </h5>
                        <ul class="list-unstyled text-muted mb-0">
                            @forelse ($vms->where('type', 'mission')->where('status', true)->sortBy('order') as $mission)
                                <li class="mb-2">
                                    <i class="bi bi-bookmark-check-fill mr-2" style="color:#1D9E75;"></i>
                                    {!! $mission->content !!}
                                </li>
                            @empty
                                <div class="alert alert-danger text-center" role="alert">
                                    Belum Ada Misi Yang Tersedia
                                </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Berita & Produk --}}
    <div class="container mb-5">

        {{-- Berita Terbaru --}}
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-md-8">
                <p class="section-label">Informasi</p>
                <h4 class="section-title"><i class="bi bi-newspaper me-2" style="color:rgb(175,140,226);"></i>Berita
                    Terbaru</h4>
                <div class="section-line"></div>
            </div>
            @if ($beritas->count() > 0)
                <div class="col-md-4 d-flex align-items-end justify-content-md-end mt-3 mt-md-0">
                    <a href="{{ route('berita') }}" class="btn btn-sm px-4 py-2 rounded-pill fw-semibold"
                        style="background: rgba(175,140,226,0.1); color: rgb(120,80,200); border: 1.5px solid rgba(175,140,226,0.35); font-size: 13px;">
                        <i class="bi bi-grid me-1"></i> Lihat Semua
                    </a>
                </div>
            @endif
        </div>

        {{-- Grid Berita --}}
        <div class="row g-3">
            @forelse ($beritas as $index)
                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
                    <div class="berita-card">

                        {{-- Gambar --}}
                        <div class="berita-img-wrap">
                            <img src="{{ asset('storage/assets/back/img/berita/' . $index->image) }}"
                                alt="{{ $index->title }}">
                            <div class="berita-img-overlay"></div>
                            <span class="berita-category-badge">
                                <i class="bi bi-newspaper me-1"></i> Berita
                            </span>
                        </div>

                        {{-- Body --}}
                        <div class="berita-body">
                            <a href="{{ route('berita.detail', $index->slug) }}" class="berita-title">
                                {{ $index->title }}
                            </a>
                            <p class="berita-excerpt mb-0">
                                {!! Str::limit(strip_tags($index->content), 100, '...') !!}
                            </p>
                        </div>

                        {{-- Footer --}}
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
                    <div class="text-center py-5" style="color:#ccc;">
                        <i class="bi bi-newspaper" style="font-size:3rem; display:block; margin-bottom:12px;"></i>
                        <p class="mb-0" style="font-size:14px;">Belum ada berita yang tersedia</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Produk & Sidebar --}}
        <div class="row mt-5">
            {{-- Produk col-8 --}}
            <div class="col-md-8">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-end mb-4" data-aos="fade-up">
                    <div>
                        <p class="section-label">Unggulan</p>
                        <h4 class="section-title">
                            <i class="bi bi-box-seam me-2" style="color:rgb(175,140,226);"></i>Produk Terbaru
                        </h4>
                        <div class="section-line"></div>
                    </div>
                    @if ($produks->count() > 0)
                        <a href="{{ route('produk') }}" class="btn btn-sm px-4 py-2 rounded-pill fw-semibold mb-1"
                            style="background:rgba(175,140,226,0.1);color:rgb(120,80,200);border:1.5px solid rgba(175,140,226,0.35);font-size:13px;">
                            <i class="bi bi-grid me-1"></i> Lihat Semua
                        </a>
                    @endif
                </div>

                <div class="row g-3">
                    @forelse ($produks as $produk)
                        <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
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
                                    <div class="produk-price">
                                        Rp {{ number_format($produk->price, 0, ',', '.') }}
                                    </div>
                                    <span class="produk-meta">
                                        <i class="bi bi-person-circle"></i>
                                        {{ $produk->user->asal_sekolah ?? 'Admin' }}
                                    </span>
                                </div>
                                <div class="produk-footer">
                                    <span class="produk-meta">
                                        <i class="bi bi-calendar3"></i>
                                        {{ $produk->created_at->diffForHumans() }}
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
                                <i class="bi bi-box-seam" style="font-size:3rem;display:block;margin-bottom:12px;"></i>
                                <p class="mb-0" style="font-size:14px;">Belum ada produk yang tersedia</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Sidebar Kategori col-4 --}}
            <div class="col-md-4 mt-4 mt-md-0" data-aos="fade-left">
                <div class="sidebar-kategori">
                    <p class="sidebar-kat-title">Filter</p>
                    <h5 class="sidebar-kat-heading">
                        <i class="bi bi-list-ul me-2" style="color:rgb(175,140,226);"></i>Kategori
                    </h5>

                    @forelse ($category as $c)
                        <a href="{{ route('produk', ['category' => $c->slug]) }}" class="kat-item">
                            <span class="d-flex align-items-center gap-2">
                                <i class="bi bi-grid-3x3-gap-fill"></i>
                                {{ $c->name }}
                            </span>
                            <span class="kat-count">{{ $c->posts_count }}</span>
                        </a>
                    @empty
                        <div class="text-center py-4" style="color:#ccc;">
                            <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                            <p class="mb-0" style="font-size:13px;">Belum ada kategori</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    </div>

    {{-- Rekanan Industri --}}
    <div class="dudi-section mt-5" data-aos="fade-up">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <p class="section-label">Kemitraan</p>
                    <h4 class="section-title text-center" style="justify-content:center;">
                        <i class="bi bi-trophy me-2" style="color:rgb(175,140,226);"></i>Rekanan Industri
                    </h4>
                    <p class="text-muted mt-2" style="font-size:13px;">
                        Mitra industri yang bekerja sama dengan TEFA MUTU
                    </p>
                    <div class="section-line mx-auto"></div>
                </div>
            </div>

            @if ($dudis->count() > 0)
                @php
                    $dudiList = $dudis->values();
                    $dudiDouble = $dudiList->merge($dudiList);
                    $half = ceil($dudiDouble->count() / 2);
                    $row1 = $dudiDouble->take($half);
                    $row2 = $dudiDouble->skip($half)->values();
                @endphp

                {{-- Baris 1 — kiri ke kanan --}}
                <div class="dudi-track-wrap mb-0">
                    <div class="dudi-track">
                        @foreach ($dudiDouble as $d)
                            <a href="{{ $d->link }}" target="_blank" class="dudi-card">
                                <div class="dudi-logo-wrap">
                                    <img src="{{ asset('storage/assets/back/img/dudi/' . $d->image) }}"
                                        alt="{{ $d->name }}">
                                </div>
                                <p class="dudi-name">{{ $d->name }}</p>
                                <p class="dudi-bidang">{{ $d->bidang }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Baris 2 — kanan ke kiri (arah berlawanan) --}}
                <div class="dudi-track-wrap mt-4">
                    <div class="dudi-track dudi-track-2">
                        @foreach ($dudiDouble->reverse() as $d)
                            <a href="{{ $d->link }}" target="_blank" class="dudi-card">
                                <div class="dudi-logo-wrap">
                                    <img src="{{ asset('storage/assets/back/img/dudi/' . $d->image) }}"
                                        alt="{{ $d->name }}">
                                </div>
                                <p class="dudi-name">{{ $d->name }}</p>
                                <p class="dudi-bidang">{{ $d->bidang }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-5" style="color:#ccc;">
                    <i class="bi bi-buildings" style="font-size:3rem;display:block;margin-bottom:12px;"></i>
                    <p class="mb-0" style="font-size:14px;">Belum ada rekanan industri yang tersedia</p>
                </div>
            @endif
        </div>
    </div>
@endsection
