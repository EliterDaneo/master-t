@extends('components.layouts.back.app', ['title' => 'Dashboard'])

@section('content')
    {{-- Stats Cards --}}
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $totalBerita }}</h3>
                    <p>Total Berita</p>
                </div>
                <i class="small-box-icon bi bi-newspaper"></i>
                <a href="{{ route('berita.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Lihat Semua <i class="bi bi-arrow-right-circle ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ $totalProduk }}</h3>
                    <p>Total Produk</p>
                </div>
                <i class="small-box-icon bi bi-box-seam"></i>
                <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Lihat Semua <i class="bi bi-arrow-right-circle ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $totalOrder }}</h3>
                    <p>Total Order</p>
                </div>
                <i class="small-box-icon bi bi-bag-check"></i>
                <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Lihat Semua <i class="bi bi-arrow-right-circle ms-1"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>{{ $totalPengguna }}</h3>
                    <p>Total Pengguna</p>
                </div>
                <i class="small-box-icon bi bi-people"></i>
                <a href="{{ route('user.index') }}"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Lihat Semua <i class="bi bi-arrow-right-circle ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Charts & Recent --}}
    <div class="row">
        {{-- Chart Berita per Bulan --}}
        <div class="col-lg-8 col-12 mb-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-bar-chart-line me-2"></i> Statistik Berita per Bulan
                    </h3>
                </div>
                <div class="card-body">
                    <div id="chartBerita"></div>
                </div>
            </div>
        </div>

        {{-- Info User Login --}}
        <div class="col-lg-4 col-12 mb-3">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-person-circle me-2"></i> Info Akun
                    </h3>
                </div>
                <div class="card-body text-center">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/assets/back/img/avatar/' . Auth::user()->avatar) }}" alt="Avatar"
                            class="img-thumbnail rounded-circle mb-3" style="width:90px;height:90px;object-fit:cover;">
                    @else
                        <div class="mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center bg-secondary"
                            style="width:90px;height:90px;">
                            <i class="bi bi-person-fill text-white" style="font-size:2.5rem;"></i>
                        </div>
                    @endif

                    <h5 class="mb-1 fw-bold">{{ Auth::user()->name }}</h5>
                    <p class="text-muted mb-2">{{ Auth::user()->email }}</p>
                    <span
                        class="badge 
                        @if (Auth::user()->role == 'admin') bg-danger
                        @elseif(Auth::user()->role == 'writer') bg-warning
                        @else bg-primary @endif">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">
                        <i class="bi bi-clock me-1"></i>
                        Login: {{ now()->format('d M Y, H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    {{-- Berita Terbaru --}}
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-clock-history me-2"></i> Berita Terbaru
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-info">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($beritaTerbaru as $no => $berita)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ Str::limit($berita->title, 50) }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $berita->category->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td>{{ $berita->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada berita</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 300,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Berita',
                    data: @json($chartData['counts'])
                }],
                xaxis: {
                    categories: @json($chartData['months'])
                },
                colors: ['#007bff'],
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '50%'
                    }
                },
                dataLabels: {
                    enabled: false
                },
            };

            var chart = new ApexCharts(document.querySelector("#chartBerita"), options);
            chart.render();
        });
    </script>
@endpush
