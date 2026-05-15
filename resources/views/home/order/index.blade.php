@extends('components.layouts.front.app', ['title' => 'Order Layanan TEFA'])

@push('styles')
    <style>
        /* ── Hero ── */
        .order-hero {
            background: linear-gradient(135deg, #1a0533 0%, #2d1060 50%, #0f2a4a 100%);
            padding: 100px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .order-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 80% 40%, rgba(175, 140, 226, 0.15) 0%, transparent 65%);
            pointer-events: none;
        }

        .order-hero-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            color: rgba(175, 140, 226, 0.9);
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .order-hero h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
        }

        .order-hero p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            margin: 0;
        }

        /* ── Breadcrumb ── */
        .order-breadcrumb {
            background: #fff;
            border-bottom: 1px solid rgba(175, 140, 226, 0.12);
            padding: 12px 0;
        }

        .order-breadcrumb .breadcrumb {
            margin: 0;
            background: none;
            font-size: 12px;
            padding: 0;
        }

        .order-breadcrumb .breadcrumb-item a {
            color: rgb(175, 140, 226);
            text-decoration: none;
            font-weight: 600;
        }

        .order-breadcrumb .breadcrumb-item.active {
            color: #aaa;
        }

        .order-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
            color: #ddd;
        }

        /* ── Step Indicator ── */
        .step-indicator {
            display: flex;
            align-items: center;
            gap: 0;
            margin-bottom: 36px;
        }

        .step-dot {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            border: 2px solid rgba(175, 140, 226, 0.3);
            color: #bbb;
            background: #fff;
            position: relative;
            z-index: 1;
            transition: all 0.3s;
            flex-shrink: 0;
        }

        .step-dot.active {
            background: rgb(175, 140, 226);
            border-color: rgb(175, 140, 226);
            color: #fff;
            box-shadow: 0 0 0 4px rgba(175, 140, 226, 0.18);
        }

        .step-dot.done {
            background: #534AB7;
            border-color: #534AB7;
            color: #fff;
        }

        .step-line {
            flex: 1;
            height: 2px;
            background: rgba(175, 140, 226, 0.2);
            margin: 0 4px;
            transition: background 0.3s;
        }

        .step-line.done {
            background: #534AB7;
        }

        .step-label {
            font-size: 10px;
            font-weight: 700;
            color: #bbb;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 6px;
            text-align: center;
        }

        .step-label.active {
            color: rgb(175, 140, 226);
        }

        .step-label.done {
            color: #534AB7;
        }

        .step-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ── Section Title ── */
        .section-eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            color: rgb(175, 140, 226);
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e1440;
            margin-bottom: 6px;
        }

        .section-sub {
            font-size: 13px;
            color: #aaa;
            margin-bottom: 28px;
        }

        /* ── Category Cards ── */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 14px;
            margin-bottom: 0;
        }

        .category-card {
            background: #fff;
            border: 2px solid rgba(175, 140, 226, 0.15);
            border-radius: 18px;
            padding: 22px 14px 18px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(.4, 0, .2, 1);
            position: relative;
            overflow: hidden;
            user-select: none;
        }

        .category-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(175, 140, 226, 0.07) 0%, rgba(83, 74, 183, 0.04) 100%);
            opacity: 0;
            transition: opacity 0.25s;
        }

        .category-card:hover {
            border-color: rgba(175, 140, 226, 0.5);
            box-shadow: 0 8px 28px rgba(83, 74, 183, 0.12);
            transform: translateY(-3px);
        }

        .category-card:hover::before {
            opacity: 1;
        }

        .category-card.selected {
            border-color: rgb(175, 140, 226);
            box-shadow: 0 8px 28px rgba(83, 74, 183, 0.18);
            transform: translateY(-3px);
            background: #faf7ff;
        }

        .category-card.selected::before {
            opacity: 1;
        }

        .category-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .category-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(175, 140, 226, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            transition: background 0.25s;
        }

        .category-card.selected .category-icon-wrap {
            background: rgba(175, 140, 226, 0.22);
        }

        .category-icon-wrap i {
            font-size: 22px;
            color: rgb(175, 140, 226);
        }

        .category-card-name {
            font-size: 13px;
            font-weight: 700;
            color: #1e1440;
            margin-bottom: 3px;
            line-height: 1.3;
        }

        .category-card-desc {
            font-size: 11px;
            color: #aaa;
            line-height: 1.4;
        }

        .category-check {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgb(175, 140, 226);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(0.5);
            transition: all 0.2s;
        }

        .category-card.selected .category-check {
            opacity: 1;
            transform: scale(1);
        }

        .category-check i {
            font-size: 10px;
            color: #fff;
        }

        /* ── Form Card ── */
        .form-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid rgba(175, 140, 226, 0.12);
            box-shadow: 0 4px 24px rgba(83, 74, 183, 0.07);
            padding: 32px 28px;
            display: none;
            animation: slideUp 0.35s cubic-bezier(.4, 0, .2, 1) both;
        }

        .form-card.visible {
            display: block;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(175, 140, 226, 0.1);
        }

        .form-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(175, 140, 226, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .form-card-icon i {
            font-size: 20px;
            color: rgb(175, 140, 226);
        }

        .form-card-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #1e1440;
            margin-bottom: 2px;
        }

        .form-card-sub {
            font-size: 12px;
            color: #aaa;
            margin: 0;
        }

        /* ── Form Controls ── */
        .form-label-custom {
            font-size: 12px;
            font-weight: 700;
            color: #1e1440;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 7px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-label-custom i {
            color: rgb(175, 140, 226);
            font-size: 13px;
        }

        .form-control-custom {
            border: 1.5px solid rgba(175, 140, 226, 0.2);
            border-radius: 12px;
            padding: 11px 15px;
            font-size: 14px;
            color: #1e1440;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fdfcff;
            width: 100%;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: rgb(175, 140, 226);
            box-shadow: 0 0 0 3px rgba(175, 140, 226, 0.12);
            background: #fff;
        }

        .form-control-custom.is-invalid {
            border-color: #e74c3c;
        }

        .invalid-feedback {
            font-size: 11px;
        }

        .form-group-custom {
            margin-bottom: 20px;
        }

        /* ── Divider ── */
        .form-divider {
            border: none;
            border-top: 1px solid rgba(175, 140, 226, 0.1);
            margin: 24px 0;
        }

        .form-section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            color: rgb(175, 140, 226);
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        /* ── WA Info Bar ── */
        .wa-info-bar {
            background: linear-gradient(135deg, #0f5c2e 0%, #1a7a40 100%);
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 20px;
        }

        .wa-info-bar-text h6 {
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 2px;
        }

        .wa-info-bar-text p {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.6);
            margin: 0;
        }

        .wa-info-bar-btn {
            margin-left: auto;
            background: #25d366;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 9px 18px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
            transition: background 0.2s, transform 0.2s;
        }

        .wa-info-bar-btn:hover {
            background: #1ebe5d;
            transform: translateY(-1px);
            color: #fff;
        }

        /* ── Submit Button ── */
        .btn-submit {
            background: linear-gradient(135deg, rgb(175, 140, 226) 0%, #534AB7 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 13px 28px;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(83, 74, 183, 0.3);
            color: #fff;
        }

        .btn-back {
            color: #aaa;
            border: 1.5px solid rgba(175, 140, 226, 0.2);
            border-radius: 12px;
            padding: 12px 22px;
            font-size: 14px;
            font-weight: 600;
            background: #fff;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            transition: border-color 0.2s, color 0.2s;
        }

        .btn-back:hover {
            border-color: rgba(175, 140, 226, 0.5);
            color: rgb(175, 140, 226);
        }

        /* ── Alert ── */
        .alert-custom {
            border-radius: 14px;
            border: none;
            padding: 16px 20px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .alert-custom-success {
            background: rgba(37, 211, 102, 0.1);
            color: #0f5c2e;
        }

        /* ── WA preview tag ── */
        .wa-preview-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(37, 211, 102, 0.12);
            color: #0f5c2e;
            border-radius: 8px;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 700;
            margin-top: 6px;
        }
    </style>
@endpush

@section('content')
    {{-- Hero --}}
    <div class="order-hero">
        <div class="container">
            <p class="order-hero-label">Buat Pesanan</p>
            <h1><i class="bi bi-cart-check me-2" style="color:rgba(175,140,226,0.8);"></i>Order Layanan</h1>
            <p>Pilih kategori layanan dan isi detail pesanan Anda.</p>
        </div>
    </div>

    {{-- Breadcrumb --}}
    <div class="order-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="bi bi-house me-1"></i>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order</li>
            </ol>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="alert-custom alert-custom-success">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Step Indicator --}}
                <div class="d-flex align-items-flex-start mb-4" style="gap:0">
                    <div class="step-wrapper">
                        <div class="step-dot active" id="step-dot-1">1</div>
                        <div class="step-label active" id="step-lbl-1">Kategori</div>
                    </div>
                    <div class="step-line" id="step-line-1" style="margin-top:18px;"></div>
                    <div class="step-wrapper">
                        <div class="step-dot" id="step-dot-2">2</div>
                        <div class="step-label" id="step-lbl-2">Detail</div>
                    </div>
                    <div class="step-line" id="step-line-2" style="margin-top:18px;"></div>
                    <div class="step-wrapper">
                        <div class="step-dot" id="step-dot-3">3</div>
                        <div class="step-label" id="step-lbl-3">Kirim</div>
                    </div>
                </div>

                {{-- ═══════════════════════ STEP 1: KATEGORI ═══════════════════════ --}}
                <div id="step-1">
                    <p class="section-eyebrow">Langkah 1 dari 3</p>
                    <h2 class="section-title">Pilih Kategori Layanan</h2>
                    <p class="section-sub">Pilih kategori yang sesuai dengan kebutuhan Anda.</p>

                    <div class="category-grid" id="category-grid">
                        @php
                            $categoryIcons = [
                                'Produk' => ['icon' => 'bi-box-seam-fill', 'desc' => 'Pemesanan produk & barang'],
                                'Jasa' => ['icon' => 'bi-tools', 'desc' => 'Layanan jasa profesional'],
                                'Pelatihan' => ['icon' => 'bi-mortarboard-fill', 'desc' => 'Workshop & pelatihan'],
                                'Magang' => ['icon' => 'bi-person-workspace', 'desc' => 'Program magang siswa'],
                                'Kerjasama' => ['icon' => 'bi-handshake-fill', 'desc' => 'Kemitraan industri'],
                                'Lainnya' => ['icon' => 'bi-grid-3x3-gap-fill', 'desc' => 'Kebutuhan lainnya'],
                            ];
                        @endphp

                        @foreach ($categories as $cat)
                            @php
                                $meta = $categoryIcons[$cat->name] ?? ['icon' => 'bi-tag-fill', 'desc' => $cat->name];
                            @endphp
                            <div class="category-card" data-category="{{ $cat->id }}" data-name="{{ $cat->name }}"
                                data-icon="{{ $meta['icon'] }}" onclick="selectCategory(this)">
                                <input type="radio" name="category_pick" value="{{ $cat->id }}">
                                <div class="category-check"><i class="bi bi-check"></i></div>
                                <div class="category-icon-wrap">
                                    <i class="bi {{ $meta['icon'] }}"></i>
                                </div>
                                <div class="category-card-name">{{ $cat->name }}</div>
                                <div class="category-card-desc">{{ $meta['desc'] }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button class="btn-submit" id="btn-to-step2" onclick="goStep2()" disabled
                            style="opacity:0.5;cursor:not-allowed;">
                            Lanjut <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>

                {{-- ═══════════════════════ STEP 2: FORM ═══════════════════════ --}}
                <div id="step-2" style="display:none;">
                    <p class="section-eyebrow">Langkah 2 dari 3</p>
                    <h2 class="section-title">Detail Pesanan</h2>
                    <p class="section-sub">Isi informasi berikut dengan lengkap.</p>

                    <form action="{{ route('order.store') }}" method="POST" id="order-form">
                        @csrf
                        <input type="hidden" name="category_id" id="hidden-category-id">

                        {{-- Form Card: Identitas --}}
                        <div class="form-card visible mb-3">
                            <div class="form-card-header">
                                <div class="form-card-icon"><i class="bi bi-person-fill"></i></div>
                                <div>
                                    <div class="form-card-title">Identitas Pemesan</div>
                                    <p class="form-card-sub">Informasi kontak untuk follow-up pesanan Anda</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="bi bi-person"></i> Nama Lengkap <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="nama" id="nama"
                                            class="form-control-custom @error('nama') is-invalid @enderror"
                                            placeholder="Nama lengkap Anda" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="bi bi-telephone"></i> No. WhatsApp <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="no_hp" id="no_hp"
                                            class="form-control-custom @error('no_hp') is-invalid @enderror"
                                            placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}"
                                            oninput="updateWaPreview(this.value)">
                                        <div class="wa-preview-tag" id="wa-preview" style="display:none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z" />
                                            </svg>
                                            Akan dihubungi via WA
                                        </div>
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="bi bi-envelope"></i> Email
                                            <span
                                                style="font-weight:400;color:#bbb;font-size:10px;text-transform:none;letter-spacing:0;">(opsional)</span>
                                        </label>
                                        <input type="email" name="email" id="email"
                                            class="form-control-custom @error('email') is-invalid @enderror"
                                            placeholder="nama@email.com" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Form Card: Detail Pesanan --}}
                        <div class="form-card visible mb-3">
                            <div class="form-card-header">
                                <div class="form-card-icon" id="detail-icon">
                                    <i class="bi bi-tag-fill" id="detail-icon-inner"></i>
                                </div>
                                <div>
                                    <div class="form-card-title" id="detail-title">Detail Pesanan</div>
                                    <p class="form-card-sub" id="detail-sub">Jelaskan kebutuhan Anda</p>
                                </div>
                            </div>

                            <div class="form-group-custom">
                                <label class="form-label-custom">
                                    <i class="bi bi-ui-checks-grid"></i> Sekolah TEFA <span class="text-danger">*</span>
                                </label>
                                <select name="sekolah" id="sekolah"
                                    class="form-control-custom @error('sekolah') is-invalid @enderror">
                                    <option disabled selected>Pilih Sekolah</option>
                                    @foreach ($sekolahs as $sekolah)
                                        <option value="{{ $sekolah->id }}"
                                            {{ old('sekolah') == $sekolah->id ? 'selected' : '' }}>
                                            {{ $sekolah->asal_sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group-custom">
                                <label class="form-label-custom">
                                    <i class="bi bi-tag"></i> Judul / Nama Pesanan <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="judul" id="judul"
                                    class="form-control-custom @error('judul') is-invalid @enderror"
                                    placeholder="Contoh: Meja Kayu Custom, Pelatihan Las, dll."
                                    value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group-custom">
                                <label class="form-label-custom">
                                    <i class="bi bi-text-left"></i> Deskripsi Kebutuhan <span class="text-danger">*</span>
                                </label>
                                <textarea name="deskripsi" id="deskripsi" rows="5"
                                    class="form-control-custom @error('deskripsi') is-invalid @enderror"
                                    placeholder="Ceritakan detail kebutuhan Anda: ukuran, jumlah, spesifikasi, permintaan khusus...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- WA Info Bar --}}
                        <div class="wa-info-bar">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z" />
                                </svg>
                            </div>
                            <div class="wa-info-bar-text">
                                <h6>Ditindaklanjuti via WhatsApp</h6>
                                <p>Tim kami akan menghubungi Anda segera setelah pesanan diterima.</p>
                            </div>
                            <a href="https://wa.me/6285785852224" target="_blank" class="wa-info-bar-btn">
                                Chat Langsung
                            </a>
                        </div>

                        <hr class="form-divider">

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn-back" onclick="goStep1()">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </button>
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-send-fill"></i> Kirim Pesanan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Script di dalam section agar fungsi terdefinisi di scope global halaman --}}
    <script>
        let selectedCategory = null;

        const categoryMeta = {
            'Produk': {
                icon: 'bi-box-seam-fill',
                title: 'Detail Produk',
                sub: 'Jelaskan produk yang ingin Anda pesan'
            },
            'Jasa': {
                icon: 'bi-tools',
                title: 'Detail Jasa',
                sub: 'Jelaskan layanan jasa yang dibutuhkan'
            },
            'Pelatihan': {
                icon: 'bi-mortarboard-fill',
                title: 'Detail Pelatihan',
                sub: 'Informasi workshop atau pelatihan'
            },
            'Magang': {
                icon: 'bi-person-workspace',
                title: 'Detail Program',
                sub: 'Informasi program magang yang diinginkan'
            },
            'Kerjasama': {
                icon: 'bi-handshake-fill',
                title: 'Detail Kerjasama',
                sub: 'Jelaskan bentuk kemitraan yang dituju'
            },
            'Lainnya': {
                icon: 'bi-grid-3x3-gap-fill',
                title: 'Detail Kebutuhan',
                sub: 'Ceritakan apa yang Anda butuhkan'
            },
        };

        function selectCategory(el) {
            document.querySelectorAll('.category-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            el.querySelector('input').checked = true;

            selectedCategory = {
                id: el.dataset.category,
                name: el.dataset.name,
                icon: el.dataset.icon
            };

            const btn = document.getElementById('btn-to-step2');
            btn.disabled = false;
            btn.style.opacity = '1';
            btn.style.cursor = 'pointer';
        }

        function goStep2() {
            if (!selectedCategory) return;

            document.getElementById('hidden-category-id').value = selectedCategory.id;

            const meta = categoryMeta[selectedCategory.name] || {
                icon: 'bi-tag-fill',
                title: 'Detail ' + selectedCategory.name,
                sub: 'Jelaskan kebutuhan Anda'
            };
            document.getElementById('detail-icon-inner').className = 'bi ' + meta.icon;
            document.getElementById('detail-title').textContent = meta.title;
            document.getElementById('detail-sub').textContent = meta.sub;

            document.getElementById('step-1').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
            setStep(2);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function goStep1() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-1').style.display = 'block';
            setStep(1);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function setStep(n) {
            for (let i = 1; i <= 3; i++) {
                const dot = document.getElementById('step-dot-' + i);
                const lbl = document.getElementById('step-lbl-' + i);
                dot.classList.remove('active', 'done');
                lbl.classList.remove('active', 'done');
                if (i < n) {
                    dot.classList.add('done');
                    lbl.classList.add('done');
                    dot.innerHTML = '<i class="bi bi-check"></i>';
                } else if (i === n) {
                    dot.classList.add('active');
                    lbl.classList.add('active');
                    dot.textContent = i;
                } else {
                    dot.textContent = i;
                }
            }
            for (let i = 1; i <= 2; i++) {
                const line = document.getElementById('step-line-' + i);
                if (line) line.classList.toggle('done', i < n);
            }
        }

        function updateWaPreview(val) {
            const preview = document.getElementById('wa-preview');
            preview.style.display = val.length >= 9 ? 'inline-flex' : 'none';
        }

        // Jika ada validation error, langsung lompat ke step 2 dengan kategori yang sudah dipilih
        @if (old('category_id'))
            document.addEventListener('DOMContentLoaded', function() {
                const catId = '{{ old('category_id') }}';
                const card = document.querySelector(`.category-card[data-category="${catId}"]`);
                if (card) {
                    selectCategory(card);
                    goStep2();
                }
            });
        @endif
    </script>
@endsection
