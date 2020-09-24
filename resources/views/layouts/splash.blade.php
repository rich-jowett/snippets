<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet">

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#1f89c7">
    <meta name="msapplication-TileColor" content="#5c1fc7">
    <meta name="theme-color" content="#f4f4f4">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>
<body>
    <div class="header header__authentication">
        @if (Route::has('login'))
            <header role="banner">
                <h2 class="accessibility__title">jowett.me</h2>
                <nav class="navigation">
                    <h2 class="navigation__header">Authentication Navigation</h2>
                    <ul class="navigation__links">
                        @auth
                            <li class="navigation__link">
                                <h3><a href="{{ url('/dashboard') }}">Dashboard</a></h3>
                            </li>
                        @else
                            <li class="navigation__link">
                                <h3><a href="{{ url('/login') }}">Login</a></h3>
                            </li>

                            @if (Route::has('register'))
                                <li class="navigation__link">
                                    <h3><a href="{{ url('/register') }}">Register</a></h3>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </nav>
            </header>
        @endif
    </div>

    <div id="wrapper" class="page page__splash">
        <div class="content">
            <section>
                {{ $slot }}
            </section>
        </div>
    </div>
</body>

<footer>
    <script src="/js/three.min.js"></script>
    <script src="/js/vanta.net.min.js"></script>
    <script>
        VANTA.NET({
            el: "#wrapper",
            mouseControls: true,
            touchControls: true,
            gyroControls: true,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x89C71F,
            backgroundColor: 0xF4F4F4,
            showDots: false
        })
    </script>
</footer>
</html>
