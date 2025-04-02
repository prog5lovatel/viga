<header>
    <section class="header">
        <div class="main flex_r middle">
            <a href="{{ route('home') }}" class="logoH whFitImg flex">
                <img src="{{ @Vite::asset('resources/assets/site/img/logo.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}">
            </a>

            <nav id="menu">
                @include('site.includes.menu')
            </nav>
        </div>
    </section>
    @include('site.includes.menuMobile')
</header>
