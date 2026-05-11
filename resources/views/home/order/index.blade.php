@extends('components.layouts.front.app', ['title' => 'Order Layanan TEFA'])

@section('content')
    <header class="pt-5 border-bottom bg-light">
        <div class="container pt-md-1 pb-md-1">
            <h1 class="bd-title mt-4 font-weight-bold"><i class="bi bi-cart" aria-hidden="true"></i> ORDER LAYANAN
            </h1>
            <p class="bd-lead">Pesan layanan atau produk dari TEFA MUTU.</p>
        </div>
    </header>

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('welcome') }}" class="text-decoration-none"><i class="bi bi-house"></i> Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none"><i class="bi bi-cart"></i> Order</a>
            </li>
        </ol>
    </nav>
    <!-- end breadcrumb -->

    <div class="container mt-4 mb-5" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Alert sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-body p-4">

                        <h5 class="font-weight-bold mb-1">
                            <i class="fa fa-file-alt mr-2" style="color: rgb(175,140,226);"></i> Form Order Layanan
                        </h5>
                        <p class="text-muted small mb-4">Isi form berikut dengan lengkap. Kami akan menghubungi Anda
                            secepatnya.</p>
                        <hr>

                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf

                            {{-- Nama Lengkap --}}
                            <div class="form-group mb-4">
                                <label for="nama"><i class="fa fa-user mr-1"></i> Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Masukkan nama lengkap Anda" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- No HP --}}
                            <div class="form-group mb-4">
                                <label for="no_hp"><i class="fa fa-phone mr-1"></i> No. HP / WhatsApp <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="no_hp" id="no_hp"
                                    class="form-control @error('no_hp') is-invalid @enderror"
                                    placeholder="Contoh: 08123456789" value="{{ old('no_hp') }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-group mb-4">
                                <label for="email"><i class="fa fa-envelope mr-1"></i> Email <span
                                        class="text-muted small">(opsional)</span></label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Contoh: nama@email.com" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jenis Layanan --}}
                            <div class="form-group mb-4">
                                <label for="jenis_layanan"><i class="fa fa-list mr-1"></i> Jenis Layanan <span
                                        class="text-danger">*</span></label>
                                <select name="jenis_layanan" id="jenis_layanan"
                                    class="form-control @error('jenis_layanan') is-invalid @enderror">
                                    <option value="" disabled selected>-- Pilih Layanan --</option>
                                    <option value="Produk" {{ old('jenis_layanan') == 'Produk' ? 'selected' : '' }}>
                                        Pemesanan Produk</option>
                                    <option value="Jasa" {{ old('jenis_layanan') == 'Jasa' ? 'selected' : '' }}>Pemesanan
                                        Jasa</option>
                                    <option value="Pelatihan" {{ old('jenis_layanan') == 'Pelatihan' ? 'selected' : '' }}>
                                        Pelatihan / Workshop</option>
                                    <option value="Magang" {{ old('jenis_layanan') == 'Magang' ? 'selected' : '' }}>Program
                                        Magang</option>
                                    <option value="Kerjasama" {{ old('jenis_layanan') == 'Kerjasama' ? 'selected' : '' }}>
                                        Kerjasama Industri</option>
                                    <option value="Lainnya" {{ old('jenis_layanan') == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya</option>
                                </select>
                                @error('jenis_layanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Judul / Nama Pesanan --}}
                            <div class="form-group mb-4">
                                <label for="judul"><i class="fa fa-tag mr-1"></i> Judul / Nama Pesanan <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="judul" id="judul"
                                    class="form-control @error('judul') is-invalid @enderror"
                                    placeholder="Contoh: Meja Kayu Custom, Pelatihan Las, dll."
                                    value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deskripsi Kebutuhan --}}
                            <div class="form-group mb-4">
                                <label for="deskripsi"><i class="fa fa-align-left mr-1"></i> Deskripsi Kebutuhan <span
                                        class="text-danger">*</span></label>
                                <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Ceritakan secara detail apa yang Anda butuhkan, ukuran, jumlah, spesifikasi, atau permintaan khusus lainnya...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="sekolah"><i class="fa fa-list mr-1"></i> Sekolah Tefa <span
                                        class="text-danger">*</span></label>
                                <select name="sekolah" id="sekolah"
                                    class="form-control @error('sekolah') is-invalid @enderror">
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

                            <hr>

                            {{-- Tombol --}}
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-arrow-left mr-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn px-4 text-white"
                                    style="background: rgb(175,140,226); border: none;">
                                    <i class="fa fa-paper-plane mr-1"></i> Kirim Pesanan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                {{-- Info kontak --}}
                <div class="card border-0 shadow-sm rounded-lg mt-4">
                    <div class="card-body p-4">
                        <h6 class="font-weight-bold mb-3"><i class="fa fa-info-circle mr-2"
                                style="color: rgb(175,140,226);"></i> Informasi Kontak</h6>
                        <p class="text-muted small mb-2">
                            <i class="fa fa-whatsapp mr-2 text-success"></i>
                            Bisa juga hubungi kami langsung via WhatsApp:
                            <a href="https://wa.me/6285785852224" target="_blank" class="font-weight-bold text-dark">
                                0857-8585-2224
                            </a>
                        </p>
                        <p class="text-muted small mb-0">
                            <i class="fa fa-clock mr-2"></i> Kami melayani order setiap hari Senin – Jumat, pukul 08.00 –
                            16.00 WIB.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
