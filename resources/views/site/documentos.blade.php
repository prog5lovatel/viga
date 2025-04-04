@extends('site.layouts.base')

@section('title', 'Documentos   - ' . config('app.name'))

@section('conteudo')

    <section class="sectionTopoInternas">
        <img src="{{ @Vite::asset('resources/assets/site/img/topoDocumentos.png') }}" alt="Documentos">
        <div class="sobreInternas main flex_c">
            <h1 class="main-t whiteFont bold margin10">Documentos</h1>
            <span class="flex lineYellow"></span>
        </div>
    </section>
    <main class="mainDocumentos">
        <section class="sectionDocumentos container">
            <div class="main flex_c margin50">
                @foreach ($documentos as $documento)
                    <a href="{{ route('documento', ['documento' => $documento->slug]) }}" target="_blank" class="itemDocumentos flex middle gap20 blackFont">
                        <figure class="whFitImg">
                            <img src="{{ @Vite::asset('resources/assets/site/img/pdfIcon.png') }}" alt="Icone Pdf">
                        </figure>
                        {{ $documento->nome }}
                    </a>
                @endforeach
            </div>
        </section>

    </main>

@endsection
