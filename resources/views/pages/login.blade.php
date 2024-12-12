<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warung Kopi Sahabat - Masuk</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logofood.ico') }}">

    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4">
                        <a class="app-logo" href="index.html">
                            <img class="logo-icon me-2" src="{{ asset('assets/images/logofood.png') }}" alt="logo">
                        </a>
                    </div>
                    <h2 class="auth-heading text-center mb-5">Login to Warung Kopi Sahabat</h2>
                    @if ($errors->any())
                        <div class="alert" style="background: #F4B7BE">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <div class="auth-form-container text-start">
                        <form class="auth-form login-form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="email mb-3">
                                <label class="sr-only" for="signin-username">Username</label>
                                <input id="signin-username" name="username" type="text"
                                    class="form-control signin-username" placeholder="Username" required="required"
                                    autofocus>
                            </div>
                            <div class="password mb-3">
                                <label class="sr-only" for="signin-password">Password</label>
                                <input id="signin-password" name="password" type="password"
                                    class="form-control signin-password" placeholder="Password" required="required">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder">

            </div>
            <div class="auth-background-mask"></div>
            <div class="auth-background-overlay p-3 p-lg-5">
                <div class="d-flex flex-column align-content-end h-100">
                    <div class="h-100"></div>
                    <div class="overlay-content p-3 p-lg-4 rounded">
                        <h5 class="mb-3 overlay-title">Motivation for today</h5>
                        <div>Our task is not only to serve delicious food but also to provide friendly and efficient
                            service. Focus on good service quality and success will follow.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>
