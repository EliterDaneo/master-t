@extends('components.layouts.front.app', ['title' => 'Detail Produk Tefa'])

@section('content')
    <header class="pt-5 border-bottom bg-light">
        <div class="container pt-md-1 pb-md-1">
            <h1 class="bd-title mt-4 font-weight-bold">
                <i class="bi bi-box-seam" aria-hidden="true"></i> PRODUK
            </h1>
            <p class="bd-lead">Produk unggulan dari Master-T.</p>
        </div>
    </header>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2">
            <li class="breadcrumb-item">
                <a href="{{ route('welcome') }}" class="text-decoration-none">
                    <i class="bi bi-house"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('produk') }}" class="text-decoration-none">
                    <i class="bi bi-box-seam"></i> Produk
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ Str::limit($produk->title, 40) }}
            </li>
        </ol>
    </nav>

    <div class="container mt-3 mb-5">
        <div class="row">

            {{-- Konten Utama --}}
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 class="fw-bold">{{ $produk->title }}</h3>
                        <div class="d-flex align-items-center gap-3 text-muted small mb-3">
                            <span>
                                <i class="bi bi-folder me-1"></i>
                                {{ $produk->category->name ?? '-' }}
                            </span>
                            <span>
                                <i class="bi bi-calendar me-1"></i>
                                {{ $produk->created_at->format('d M Y') }}
                            </span>
                            <span>
                                <i class="bi bi-person me-1"></i>
                                {{ $produk->user->name ?? '-' }}
                            </span>
                        </div>
                        <hr>
                        @if ($produk->image)
                            <img src="{{ asset('storage/assets/back/img/produk/' . $produk->image) }}"
                                class="w-100 rounded mb-3" style="max-height:400px;object-fit:cover;">
                        @endif
                        <div class="mt-3">
                            {!! $produk->content !!}
                        </div>

                        {{-- Tombol WhatsApp --}}
                        <hr class="mt-4">
                        <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3 mt-3">
                            <div>
                                <p class="mb-1 fw-semibold">Tertarik dengan produk ini?</p>
                                <p class="text-muted small mb-0">Hubungi kami langsung via WhatsApp untuk informasi lebih
                                    lanjut.</p>
                            </div>
                            @php
                                $nomorWA = '6281234567890'; // Ganti dengan nomor WA tujuan
                                $pesanWA = urlencode(
                                    "Halo, saya tertarik dengan produk *{$produk->title}* yang saya lihat di website Master-T. Boleh saya mendapatkan informasi lebih lanjut mengenai produk ini?",
                                );
                            @endphp
                            <a href="https://wa.me/{{ $nomorWA }}?text={{ $pesanWA }}" target="_blank"
                                class="btn btn-success d-flex align-items-center gap-2 px-4 py-2 ms-sm-auto flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                </svg>
                                Hubungi via WhatsApp
                            </a>
                        </div>

                    </div>
                </div>

                {{-- Produk Terkait --}}
                @if ($produkTerkait->count() > 0)
                    <div class="mt-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-box-seam me-2"></i> Produk Terkait
                        </h5>
                        <div class="row">
                            @foreach ($produkTerkait as $terkait)
                                <div class="col-md-4 mb-3">
                                    <div class="card border-0 shadow-sm rounded h-100">
                                        <img src="{{ asset('storage/assets/back/img/produk/' . $terkait->image) }}"
                                            class="w-100"
                                            style="height:140px;object-fit:cover;border-top-left-radius:.3rem;border-top-right-radius:.3rem;">
                                        <div class="card-body p-2">
                                            <a href="{{ route('produk.detail', $terkait->slug) }}"
                                                class="text-dark text-decoration-none">
                                                <h6 class="small fw-bold">{{ Str::limit($terkait->title, 60) }}</h6>
                                            </a>
                                        </div>
                                        <div class="card-footer bg-white p-2">
                                            <small class="text-muted">
                                                <i class="bi bi-calendar me-1"></i>
                                                {{ $terkait->created_at->format('d M Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-md-4">

                {{-- Tombol WA Sidebar --}}
                <div class="card border-0 shadow-sm rounded mb-4 bg-success text-white">
                    <div class="card-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                            viewBox="0 0 16 16" class="mb-2">
                            <path
                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                        </svg>
                        <h6 class="fw-bold mb-1">Tanya Produk Ini</h6>
                        <p class="small mb-3 opacity-75">Konsultasi gratis, kami siap membantu Anda!</p>
                        <a href="https://wa.me/{{ $nomorWA }}?text={{ $pesanWA }}" target="_blank"
                            class="btn btn-white btn-light fw-semibold w-100">
                            <i class="bi bi-chat-dots me-1"></i> Chat Sekarang
                        </a>
                    </div>
                </div>

                {{-- Produk Terbaru --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-clock me-2"></i> PRODUK TERBARU
                    </h5>
                    @foreach ($produkTerbaru as $baru)
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body p-2">
                                <div class="d-flex gap-2">
                                    <img src="{{ asset('storage/assets/back/img/produk/' . $baru->image) }}"
                                        style="width:70px;height:60px;object-fit:cover;border-radius:.3rem;">
                                    <div>
                                        <a href="{{ route('show.produk', $baru->slug) }}"
                                            class="text-dark text-decoration-none">
                                            <h6 class="small fw-bold mb-1">{{ Str::limit($baru->title, 50) }}</h6>
                                        </a>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar me-1"></i>
                                            {{ $baru->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Kategori --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-list me-2"></i> KATEGORI PRODUK
                    </h5>
                    <div class="list-group">
                        @foreach ($categories as $cat)
                            <a href="{{ route('produk', ['category' => $cat->slug]) }}"
                                class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="bi bi-list-check me-2"></i>
                                    {{ $cat->name }}
                                </span>
                                <span class="badge bg-primary rounded-pill">{{ $cat->produks_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
