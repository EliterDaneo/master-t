<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="icon" href="{{ asset('assets/images/Logo.jpeg') }}" type="image/jpeg">

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/styles.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    @stack('styles')
</head>

<body style="background:#e2e8f0">

    <x-layouts.front.navbar />

    @yield('content')

    <x-layouts.front.footer />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var carousel = document.getElementById('myCarousel');
            if (carousel) {
                new bootstrap.Carousel(carousel, {
                    interval: 3000, // ganti ms sesuai kebutuhan
                    ride: 'carousel',
                    wrap: true,
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
