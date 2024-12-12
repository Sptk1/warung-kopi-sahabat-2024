<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warung Kopi Sahabat @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logofood.ico') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.2.1-web/css/all.css') }}">

    {{-- trix --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/trix.css') }}">

    <style>
        /* trix css  */
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

        trix-toolbar [data-trix-button-group="text-tools"] button[title="Link"] {
            display: none;
        }

        trix-toolbar [data-trix-button-group="block-tools"] button[title="Code"] {
            display: none;
        }

        trix-editor {
            background-color: #fff;
        }
    </style>
</head>

<body class="app">
    <header class="app-header fixed-top">
        @include('components.header')
        @include('components.sidebar')
    </header>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-4 mb-4">
                    @yield('container')
                </div>
                @yield('section')
            </div>
        </div>
    </div>
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
    {{-- trix --}}
    <script src="{{ asset('assets/js/trix.umd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/password.js') }}"></script>

    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
    <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(async function(OneSignal) {
            await OneSignal.init({
                appId: "f14db231-5ef8-4150-b0cc-69f6d3d766e1",
            });
            console.log(OneSignal.User.PushSubscription.id);
        });
    </script>
</body>

</html>
