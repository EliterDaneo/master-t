@extends('components.layouts.front.app', ['title' => 'List Produk Tefa'])

@section('content')
    <header class="pt-5 border-bottom bg-light">
        <div class="container pt-md-1 pb-md-1">
            <h1 class="bd-title mt-4 font-weight-bold"><i class="bi bi-bag" aria-hidden="true"></i> Produk
            </h1>
            <p class="bd-lead">Produk terbaru tentang Master-T.</p>
        </div>
    </header>

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('welcome') }}" class="text-decoration-none"><i class="bi bi-house"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('produk') }}" class="text-decoration-none"><i class="bi bi-bag"></i>
                    Produk</a>
            </li>
        </ol>
    </nav>
    <!-- end breadcrumb -->

    <div class="container mt-3 mb-5">
        <div class="row">

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
                            <img src="{{ asset('storage/assets/back/img/produk/' . $produk->image) }}" class="card-img-top"
                                alt="{{ $produk->title }}"
                                style="height:220px; object-fit:cover; transition: transform 0.5s ease;">
                        </div>

                        <div class="card-body d-flex flex-column">
                            <a href="{{ route('show.produk', $produk->slug) }}" class="text-dark text-decoration-none">
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
                                    <i class="bi bi-calendar mr-1"></i>
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
                    <img src="https://illustrations.popsy.co/amber/empty-cart.svg" style="width: 200px;" alt="Kosong">
                    <h5 class="mt-4 text-muted">Belum Ada Produk Yang Tersedia</h5>
                    <p class="text-muted small">Coba hubungi kami untuk informasi lebih lanjut.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
