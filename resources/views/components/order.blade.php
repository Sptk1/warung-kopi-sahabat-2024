<!DOCTYPE html>
<html lang="en">

<head>
    <title>Warung Kopi Sahabat @yield('title')</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logofood.ico') }}">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.2.1-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/payment.css') }}">
</head>

<body>
    <header>
        @include('components.sidebar')
    </header>
    <div class="app-wrapper">
        <div class="app-content">
            <div class="container-xl page-order">
                <div class="row h-100">
                    @yield('container')
                </div>
            </div>
        </div>
    </div>
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
