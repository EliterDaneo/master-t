@extends('components.layouts.front.app', ['title' => 'List Berita Tefa'])

@section('content')
    <header class="pt-5 border-bottom bg-light">
        <div class="container pt-md-1 pb-md-1">
            <h1 class="bd-title mt-4 font-weight-bold"><i class="bi bi-newspaper" aria-hidden="true"></i> BERITA
            </h1>
            <p class="bd-lead">Berita terbaru tentang Master-T.</p>
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
                <a href="{{ route('berita') }}" class="text-decoration-none"><i class="bi bi-newspaper"></i>
                    Berita</a>
            </li>
        </ol>
    </nav>
    <!-- end breadcrumb -->

    <div class="container mt-3 mb-5">
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
                            <p class="text-muted small mb-0">
                                {!! Str::limit($index->content, 100, '...') !!}
                            </p>
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
                    Belum Ada Berita Yang Tersedia
                </div>
            @endforelse
        </div>
    </div>
@endsection
