@extends('components.layouts.front.app', ['title' => 'Kontak Kami'])

@push('styles')
    <style>
        .kontak-hero {
            background: linear-gradient(135deg, #1a0533 0%, #2d1060 50%, #0f2a4a 100%);
            padding: 100px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .kontak-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 80% 40%, rgba(175, 140, 226, 0.15) 0%, transparent 65%);
            pointer-events: none;
        }

        .kontak-hero-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            color: rgba(175, 140, 226, 0.9);
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .kontak-hero h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
        }

        .kontak-hero p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            margin: 0;
        }

        .kontak-breadcrumb {
            background: #fff;
            border-bottom: 1px solid rgba(175, 140, 226, 0.12);
            padding: 12px 0;
        }

        .kontak-breadcrumb .breadcrumb {
            margin: 0;
            background: none;
            font-size: 12px;
            padding: 0;
        }

        .kontak-breadcrumb .breadcrumb-item a {
            color: rgb(175, 140, 226);
            text-decoration: none;
            font-weight: 600;
        }

        .kontak-breadcrumb .breadcrumb-item.active {
            color: #aaa;
        }

        .kontak-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
            color: #ddd;
        }

        /* Map Card */
        .map-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid rgba(175, 140, 226, 0.12);
            box-shadow: 0 4px 24px rgba(83, 74, 183, 0.07);
            overflow: hidden;
        }

        .map-card iframe {
            display: block;
            width: 100%;
            height: 420px;
            border: none;
        }

        /* Info Card */
        .info-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid rgba(175, 140, 226, 0.12);
            box-shadow: 0 4px 24px rgba(83, 74, 183, 0.07);
            padding: 32px 28px;
            height: 100%;
        }

        .info-card-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            color: rgb(175, 140, 226);
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .info-card-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: #1e1440;
            margin-bottom: 6px;
        }

        .info-card-sub {
            font-size: 13px;
            color: #aaa;
            margin-bottom: 28px;
        }

        .info-divider {
            border: none;
            border-top: 1px solid rgba(175, 140, 226, 0.15);
            margin: 20px 0;
        }

        .kontak-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid rgba(175, 140, 226, 0.08);
        }

        .kontak-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .kontak-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(175, 140, 226, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .kontak-icon i {
            color: rgb(175, 140, 226);
            font-size: 18px;
        }

        .kontak-item-label {
            font-size: 10px;
            font-weight: 700;
            color: #bbb;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .kontak-item-value {
            font-size: 14px;
            font-weight: 600;
            color: #1e1440;
            margin: 0;
        }

        .kontak-item-value a {
            color: #534AB7;
            text-decoration: none;
        }

        .kontak-item-value a:hover {
            color: rgb(175, 140, 226);
        }

        /* WA Float Button */
        .wa-float-section {
            margin-top: 28px;
            padding: 22px 24px;
            background: linear-gradient(135deg, #0f5c2e 0%, #1a7a40 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .wa-float-text h6 {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 3px;
        }

        .wa-float-text p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.65);
            margin: 0;
        }

        .wa-float-btn {
            margin-left: auto;
            background: #25d366;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 7px;
            flex-shrink: 0;
            transition: background 0.2s, transform 0.2s;
            white-space: nowrap;
        }

        .wa-float-btn:hover {
            background: #1ebe5d;
            transform: translateY(-2px);
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="kontak-hero">
        <div class="container">
            <p class="kontak-hero-label">Hubungi Kami</p>
            <h1><i class="bi bi-telephone me-2" style="color:rgba(175,140,226,0.8);"></i>Kontak</h1>
            <p>Kami siap membantu Anda. Jangan ragu untuk menghubungi kami.</p>
        </div>
    </div>

    <div class="kontak-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="bi bi-house me-1"></i>Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kontak</li>
            </ol>
        </div>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row g-4">

            {{-- Peta --}}
            <div class="col-md-7" data-aos="fade-right">
                <div class="map-card">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7919.292791494065!2d110.4102916003752!3d-7.05077155011837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1778147201216!5m2!1sen!2sid"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            {{-- Info Kontak --}}
            <div class="col-md-5" data-aos="fade-left">
                <div class="info-card">
                    <p class="info-card-label">Informasi</p>
                    <h4 class="info-card-title">Kontak Kami</h4>
                    <p class="info-card-sub">Temukan kami di lokasi atau hubungi via kontak di bawah ini.</p>

                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <p class="kontak-item-label">Alamat</p>
                            <p class="kontak-item-value">Jl. KH Ahmad Dahlan No 6,<br>Kab. Wonosobo, Jawa Tengah</p>
                        </div>
                    </div>

                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <p class="kontak-item-label">Telepon</p>
                            <p class="kontak-item-value">
                                <a href="tel:+6285785852224">+62 857-8585-2224</a>
                            </p>
                        </div>
                    </div>

                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <p class="kontak-item-label">Email</p>
                            <p class="kontak-item-value">
                                <a href="mailto:info@tefa.sch.id">info@tefa.sch.id</a>
                            </p>
                        </div>
                    </div>

                    <div class="kontak-item">
                        <div class="kontak-icon"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <p class="kontak-item-label">Jam Operasional</p>
                            <p class="kontak-item-value">Senin – Jumat, 08.00 – 16.00 WIB</p>
                        </div>
                    </div>

                    {{-- WA Section --}}
                    <div class="wa-float-section mt-3">
                        <div class="wa-float-text">
                            <h6>Chat via WhatsApp</h6>
                            <p>Respon cepat, langsung terhubung!</p>
                        </div>
                        <a href="https://wa.me/6285785852224" target="_blank" class="wa-float-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                            </svg>
                            Chat Sekarang
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
