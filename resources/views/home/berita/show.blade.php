@extends('components.layouts.front.app', ['title' => 'Detail Berita Tefa'])

@section('content')
    <header class="pt-5 border-bottom bg-light">
        <div class="container pt-md-1 pb-md-1">
            <h1 class="bd-title mt-4 font-weight-bold">
                <i class="bi bi-newspaper" aria-hidden="true"></i> BERITA
            </h1>
            <p class="bd-lead">Berita terbaru tentang Master-T.</p>
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
                <a href="{{ route('berita') }}" class="text-decoration-none">
                    <i class="bi bi-newspaper"></i> Berita
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ Str::limit($post->title, 40) }}
            </li>
        </ol>
    </nav>

    <div class="container mt-3 mb-5">
        <div class="row">

            {{-- Konten Utama --}}
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 class="fw-bold">{{ $post->title }}</h3>
                        <div class="d-flex align-items-center gap-3 text-muted small mb-3">
                            <span>
                                <i class="bi bi-folder me-1"></i>
                                {{ $post->category->name ?? '-' }}
                            </span>
                            <span>
                                <i class="bi bi-calendar me-1"></i>
                                {{ $post->created_at->format('d M Y') }}
                            </span>
                            <span>
                                <i class="bi bi-person me-1"></i>
                                {{ $post->user->name ?? '-' }}
                            </span>
                        </div>
                        <hr>
                        @if ($post->image)
                            <img src="{{ asset('storage/assets/back/img/berita/' . $post->image) }}"
                                class="w-100 rounded mb-3" style="max-height:400px;object-fit:cover;">
                        @endif
                        <div class="mt-3">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>

                {{-- Berita Terkait --}}
                @if ($beritaTerkait->count() > 0)
                    <div class="mt-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-newspaper me-2"></i> Berita Terkait
                        </h5>
                        <div class="row">
                            @foreach ($beritaTerkait as $terkait)
                                <div class="col-md-4 mb-3">
                                    <div class="card border-0 shadow-sm rounded h-100">
                                        <img src="{{ asset('storage/assets/back/img/berita/' . $terkait->image) }}"
                                            class="w-100"
                                            style="height:140px;object-fit:cover;border-top-left-radius:.3rem;border-top-right-radius:.3rem;">
                                        <div class="card-body p-2">
                                            <a href="{{ route('berita.detail', $terkait->slug) }}"
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

                {{-- Berita Terbaru --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-clock me-2"></i> BERITA TERBARU
                    </h5>
                    @foreach ($beritaTerbaru as $baru)
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body p-2">
                                <div class="d-flex gap-2">
                                    <img src="{{ asset('storage/assets/back/img/berita/' . $baru->image) }}"
                                        style="width:70px;height:60px;object-fit:cover;border-radius:.3rem;">
                                    <div>
                                        <a href="{{ route('berita.detail', $baru->slug) }}"
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
                        <i class="bi bi-list me-2"></i> KATEGORI BERITA
                    </h5>
                    <div class="list-group">
                        @foreach ($categories as $cat)
                            <a href="{{ route('berita', ['category' => $cat->slug]) }}"
                                class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="bi bi-list-check me-2"></i>
                                    {{ $cat->name }}
                                </span>
                                <span class="badge bg-primary rounded-pill">{{ $cat->posts_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
