<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <!-- Google Font: Source Sans Pro --> --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    {{-- <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}"> --}}
    @vite('resources/sass/app.scss')

    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/"></a>
        </div>
        {{-- <!-- /.login-logo --> --}}
        <div class="card">
            @yield('content')
        </div>
    </div>
    {{-- <!-- /.login-box --> --}}

    @vite('resources/js/app.js')
    {{-- <!-- Bootstrap 4 --> --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
