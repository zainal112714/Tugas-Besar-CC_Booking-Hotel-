<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Document</title>
    @vite('resources/sass/app1.scss')
    <style>
        /* Gaya untuk menu dropdown */
        .dropdown-menu {
            background-color: #f8f9fa; /* Warna latar belakang */
            border: none; /* Hapus garis border */
        }

        .dropdown-menu a {
            color: #333; /* Warna teks */
        }

        .dropdown-menu a:hover {
            background-color: #4a8dd1; /* Warna latar belakang saat dihover */
        }

        .dropdown-menu .dropdown-item {
            padding: 8px 16px; /* Padding untuk elemen dropdown item */
        }

        .dropdown-menu .dropdown-item i {
            margin-right: 8px; /* Margin kanan untuk ikon di dalam dropdown item */
        }
    </style>
</head>
<body>
        <div class="d-flex" id="wrapper">
@include('layouts.nav1')
@yield('content')
@vite('resources/js/app.js')
@include('sweetalert::alert')
@stack('scripts')

</div>

<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };
</script>
</body>
</html>
