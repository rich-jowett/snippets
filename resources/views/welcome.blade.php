<x-splash-layout>
    <header>
        <h1>
            <span class="accessibility__title">jowett.me</span>
            <a href="{{ config('app.url', '/') }}">
                <img src="/logo.svg" alt="jowett.me Logo" class="logo"/>
            </a>
        </h1>
    </header>
    <nav class="navigation">
        <h2 class="navigation__header">Page Navigation</h2>
        <ul class="navigation__links">
            <li class="navigation__link"><h3><a href="/rich-jowett">Rich Jowett</a></h3></li>
            <li class="navigation__link"><h3><a href="/get-in-touch">Get in Touch</a></h3></li>
            <li class="navigation__link"><h3><a href="/snippets">Snippets</a></h3></li>
            <li class="navigation__link"><h3><a href="https://www.linkedin.com/in/richardjowett/">LinkedIn</a></h3></li>
            <li class="navigation__link"><h3><a href="https://github.com/rich-jowett/">GitHub</a></h3></li>
        </ul>
    </nav>
</x-splash-layout>
