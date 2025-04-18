@extends('site.layouts.base')

@section('title', 'Obras - ' . config('app.name'))

@section('conteudo')

    <section class="sectionTopoInternas">
        <img src="{{ @Vite::asset('resources/assets/site/img/topoObras.png') }}" alt="Obras">
        <div class="sobreInternas main flex_c">
            <h1 class="main-t whiteFont bold margin10">Obras</h1>
            <span class="flex lineYellow"></span>
        </div>
    </section>
    <main class="mainObras">
        <section class="obrasSection container">
            <div class="main flex_c">
                <p>Em nosso portfólio, destacamos algumas das principais obras realizadas ao longo dos anos, com projetos de grande impacto em diversas cidades e rodovias. Cada obra é executada com o compromisso de atender aos mais altos padrões de qualidade e segurança.</p>

                <div class="grid3 gridServicos margin50">
                    @foreach ($obras as $obra)
                    <a href="{{ route('obras.detalhes',['slugObra' => $obra->slug]) }}" class="flex_c itemServicos">
                        <img src="{{ $obra->foto }}" alt="{{ $obra->nome }}">
                        <div class="flex_c middle sobreServicos">
                            <h2 class="med-t whiteFont t-center center bold">
                                {{ $obra->nome }}
                            </h2>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

@endsection
