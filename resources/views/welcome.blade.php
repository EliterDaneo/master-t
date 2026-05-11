@extends('components.layouts.front.app', ['title' => 'Selamat Datang di TEFA MUTU'])

@section('content')
    {{-- Slider --}}
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" style="position: relative;">
        <div
            style="
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0) 50%);
        z-index: 1;
        pointer-events: none;">
        </div>

        <ol class="carousel-indicators" style="z-index: 2;">
            @foreach ($sliders as $index => $s)
                <li data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}"
                    class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
        </ol>

        <div class="carousel-inner">
            @forelse ($sliders as $s)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset('assets/back/img/slider/' . $s->image) }}" alt="{{ $s->title }}" class="w-100"
                        style="height: 100vh; object-fit: cover; object-position: center;">
                    @if ($s->title)
                        <div class="carousel-caption" style="z-index: 2;">
                            <div class="alert alert-info" role="alert">
                                <h5>{{ $s->title }}</h5>
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <div class="carousel-item active">
                    <div class="alert alert-danger text-center" role="alert">
                        Belum Ada Slider Yang Tersedia
                    </div>
                </div>
            @endforelse
        </div>

        <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev" style="z-index: 2;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next" style="z-index: 2;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
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

        @forelse ($levels as $level => $members)
            {{-- Card per level --}}
            <div class="row justify-content-center mb-3" data-aos="fade-up">
                @foreach ($members->sortBy('order') as $struktur)
                    <div class="col-md-3 mb-3">
                        <div class="card text-center border-0 shadow-sm rounded-lg h-100"
                            @if ($level == $levels->keys()->first()) style="border-top: 3px solid {{ $struktur->bg_color }} !important;" @endif>
                            <div class="card-body">
                                <div class="mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center overflow-hidden"
                                    style="width:70px;height:70px;background:{{ $struktur->bg_color }};">
                                    <img src="{{ asset('assets/back/img/struktur/' . $struktur->image) }}"
                                        alt="{{ $struktur->name }}" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                                <h6 class="font-weight-bold mb-1">{{ $struktur->name }}</h6>
                                <p class="text-muted small mb-2">{{ $struktur->title }}</p>
                                <span class="badge badge-pill px-3 py-2"
                                    style="background:{{ $struktur->bg_color }};color:#fff;font-size:11px;">
                                    {{ $struktur->position_label }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Garis penghubung antar level (kecuali level terakhir) --}}
            @if (!$loop->last)
                <div class="row justify-content-center mb-0">
                    <div class="col-md-3 text-center">
                        <div style="width:2px;height:30px;background:rgb(175,140,226);margin:0 auto;"></div>
                    </div>
                </div>
                <div class="row justify-content-center mb-0">
                    <div class="col-md-{{ min($levels->get($levels->keys()[$loop->index + 1])->count() * 3, 9) }}">
                        <div style="height:2px;background:rgb(175,140,226);"></div>
                    </div>
                </div>
                <div class="row justify-content-center mb-3">
                    @foreach ($levels->get($levels->keys()[$loop->index + 1]) as $next)
                        <div class="col-md-3 text-center">
                            <div style="width:2px;height:30px;background:rgb(175,140,226);margin:0 auto;"></div>
                        </div>
                    @endforeach
                </div>
            @endif
        @empty
            <div class="alert alert-danger text-center" role="alert">
                Belum Ada Struktur Organisasi Yang Tersedia
            </div>
        @endforelse

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
        <div class="row mb-2">
            <div class="col-md-12">
                <h4><i class="bi bi-newspaper"></i> BERITA TERBARU</h4>
                <hr style="border-top: 3px solid rgb(175,140,226); width: 60px; margin-left: 0;">
            </div>
        </div>
        <div class="row">
            @forelse ($beritas as $index)
                {{-- Contoh jika menggunakan loop --}}
                <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="50">
                    <div class="card h-100 shadow-sm border-0 rounded-lg">
                        <img src="{{ asset('storage/assets/back/img/berita/' . $index->image) }}" class="w-100"
                            style="height:200px;object-fit:cover;border-top-left-radius:.3rem;border-top-right-radius:.3rem;">
                        <div class="card-body">
                            <a href="{{ route('berita.detail', $index->slug) }}" class="text-dark text-decoration-none">
                                <h6>{{ $index->title }}</h6>
                            </a>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                            <span>
                                <i class="bi bi-calendar"></i>
                                {{ $index->created_at->diffForHumans() }}
                            </span>

                            <span>
                                <i class="bi bi-people"></i>
                                {{ $index->user->asal_sekolah ?? 'Admin' }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger text-center" role="alert">
                    Belum Ada Beita Yang Tersedia
                </div>
            @endforelse
        </div>
        @if ($beritas->count() > 0)
            <div class="col-md-12 text-center mt-2 mb-3" data-aos="fade-up">
                <a href="{{ route('berita') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-arrows-fullscreen mr-2"></i> Lihat Semua Berita
                </a>
            </div>
        @endif

        {{-- Produk & Sidebar --}}
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h4><i class="bi bi-box-seam"></i> PRODUK TERBARU</h4>
                        <hr style="border-top: 3px solid rgb(175,140,226); width: 60px; margin-left: 0;">
                    </div>
                    @forelse ($produks as $produk)
                        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden product-card">
                                {{-- Label Kategori (Opsional jika ada relasi) --}}
                                <div class="position-absolute px-3 py-1 bg-primary text-white small rounded-right"
                                    style="z-index: 1; top: 15px; left: 0;">
                                    {{ $produk->category->name ?? 'Produk' }}
                                </div>

                                {{-- Image dengan Wrap untuk Efek Hover --}}
                                <div class="img-wrapper">
                                    <img src="{{ asset('storage/assets/back/img/produk/' . $produk->image) }}"
                                        class="card-img-top" alt="{{ $produk->title }}"
                                        style="height:220px; object-fit:cover; transition: transform 0.5s ease;">
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <a href="{{ route('show.produk', $produk->slug) }}"
                                        class="text-dark text-decoration-none">
                                        <h5 class="card-title font-weight-bold mb-2" style="font-size: 1.1rem;">
                                            {{ Str::limit($produk->title, 45) }}
                                        </h5>
                                    </a>

                                    {{-- Label Harga --}}
                                    <div class="mt-auto">
                                        <h5 class="text-primary font-weight-bold mb-0">
                                            Rp {{ number_format($produk->price, 0, ',', '.') }}
                                        </h5>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top-0 pb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ $produk->created_at->diffForHumans() }}
                                        </small>
                                        <a href="{{ route('show.produk', $produk->slug) }}"
                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 py-5 text-center">
                            <img src="https://illustrations.popsy.co/amber/empty-cart.svg" style="width: 200px;"
                                alt="Kosong">
                            <h5 class="mt-4 text-muted">Belum Ada Produk Yang Tersedia</h5>
                            <p class="text-muted small">Coba hubungi kami untuk informasi lebih lanjut.</p>
                        </div>
                    @endforelse
                </div>
                @if ($produks->count() > 0)
                    <div class="col-md-12 text-center mt-2 mb-3" data-aos="fade-up">
                        <a href="{{ route('produk') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrows-fullscreen mr-2"></i> Lihat Semua Produk
                        </a>
                    </div>
                @endif
            </div>
            {{-- Sidebar Kategori --}}
            <div class="col-md-4" data-aos="fade-left">
                <div class="mb-4 mt-5">
                    <h4><i class="bi bi-list"></i> KATEGORI</h4>
                </div>
                <div class="list-group">
                    @forelse ($category as $c)
                        <a href="{{ route('produk', ['category' => $c->slug]) }}"
                            class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded d-flex justify-content-between align-items-center">
                            <span>
                                <i class="bi bi-list-check me-2"></i>
                                {{ $c->name }}
                            </span>
                            <span class="badge bg-primary rounded-pill">{{ $c->posts_count }}</span>
                        </a>
                    @empty
                        <div class="alert alert-danger" role="alert">
                            Belum Ada Kategori Yang Tersedia
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    </div>

    {{-- Rekanan Industri --}}
    <div class="py-5" data-aos="fade-up">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <h4><i class="bi bi-trophy"></i> REKANAN INDUSTRI</h4>
                    <p class="text-muted">Mitra industri yang bekerja sama dengan TEFA MUTU</p>
                    <hr style="border-top: 3px solid rgb(175,140,226); width: 60px; margin: 0 auto 1.5rem;">
                </div>
            </div>

            <div id="rekananCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            @forelse ($dudis as $d)
                                <div class="col-6 col-md-3 mb-3">
                                    <a href="{{ $d->link }}" target="_blank" class="text-decoration-none">
                                        <div class="card border-0 shadow-sm rounded-lg text-center py-3 h-100">
                                            <div class="card-body">
                                                <div class="mx-auto mb-2 rounded d-flex align-items-center justify-content-center overflow-hidden"
                                                    style="width:56px;height:56px;background:#E6F1FB;">
                                                    <img src="{{ asset('assets/back/img/dudi/' . $d->image) }}"
                                                        alt="{{ $d->name }}"
                                                        style="width:100%;height:100%;object-fit:contain;">
                                                </div>
                                                <p class="mb-0 small font-weight-bold text-dark">{{ $d->name }}</p>
                                                <p class="mb-0 text-muted" style="font-size:11px;">{{ $d->bidang }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert">
                                        Belum Ada DUDI Yang Tersedia
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
