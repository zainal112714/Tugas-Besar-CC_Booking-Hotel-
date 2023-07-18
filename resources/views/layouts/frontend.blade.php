<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- =============== BOXICONS =============== --}}
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    {{-- =============== SWIPER CSS =============== --}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/libraries/swiper-bundle.min.css') }}" />

    {{-- =============== CSS =============== --}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />

    @stack('style-alt')
    <title>Gown Website</title>
</head>

<body>
    {{-- ==================== HEADER ==================== --}}
    @include('layouts.nav')

    {{-- ==================== MAIN ==================== --}}
    <main class="main">
        @yield('content')
    </main>

    {{-- ==================== FOOTER ==================== --}}
    @include('layouts.footer')

    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="bx bx-chevrons-up"></i>
    </a>

    {{-- =============== SCROLLREVEAL =============== --}}
    <script src="{{ asset('frontend/assets/libraries/scrollreveal.min.js') }}"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="{{ asset('frontend/assets/libraries/swiper-bundle.min.js') }}"></script>

    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    @stack('script-alt')
</body>

</html>
