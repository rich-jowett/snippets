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

@if (Route::has('login'))
    <header class="header" role="banner">
        <div class="header__content">
            <div class="header__logo">
                <h2>
                    <span class="accessibility__title">jowett.me</span>
                    <a href="{{ config('app.url', '/') }}">
                        <img src="/logo.svg" alt="jowett.me Logo" class="logo"/>
                    </a>
                </h2>
            </div>

            <div class="header__nav">
                <button id="hamburger" class="hamburger hamburger--collapse" type="button" aria-label="Menu" aria-controls="navigation">
                  <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                  </span>
                </button>

                <nav id="navigation" class="navigation">
                    <h2 class="navigation__header">Navigation</h2>
                    <ul class="navigation__links">
                        <li class="navigation__link"><h3><a class="{{ (url('/rich-jowett') === url()->current()) ? 'navigation__link--active' : '' }}" href="/rich-jowett">Rich Jowett</a></h3></li>
                        <li class="navigation__link"><h3><a class="{{ (url('/get-in-touch') === url()->current()) ? 'navigation__link--active' : '' }}" href="/get-in-touch">Get in Touch</a></h3></li>
                        <li class="navigation__link"><h3><a class="{{ (url('/snippets') === url()->current()) ? 'navigation__link--active' : '' }}" href="/snippets">Snippets</a></h3></li>
                        <li class="navigation__link navigation__link--social"><h3><a href="https://www.linkedin.com/in/richardjowett/">LinkedIn</a></h3></li>
                        <li class="navigation__link navigation__link--social"><h3><a href="https://github.com/rich-jowett/">GitHub</a></h3></li>

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
            </div>
        </div>

    </header>
@endif

<div id="wrapper" class="page page__content">
    <div class="content">
        <section>
            {{ $slot }}
        </section>
    </div>
</div>


<script src="/js/main.js"></script>
</body>
</html>
