@extends('site.layouts.base')

@section('title',  $servico->nome . ' - ' . config('app.name'))

@section('pageLinks')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/css/swiper.css">
    @vite(['resources/assets/site/css/slides.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css">
@endsection
@section('conteudo')

    <section class="sectionTopoInternas">
        <img src="{{ @Vite::asset('resources/assets/site/img/topoServicos.png') }}" alt="Serviços">
        <div class="sobreInternas main flex_c">
            <h1 class="main-t whiteFont bold margin10">{{ $servico->nome}}</h1>
            <span class="flex lineYellow"></span>
        </div>
    </section>
    <main class="mainServicosDetalhes">
        <section class="servicosSection container">
            <div class="main flex_r">
                <div class="flex_c e_input fotoDetalhes">
                    <div class="sliderProdutos fullW" id="detail">
                        <div class="swiper-container gallery-slider">
                            <div class="swiper-wrapper">
                                <a href="{{ $servico->foto }}" class="swiper-slide" data-fancybox="{{ $servico->nome }}">
                                    <figure>
                                        <img src="{{ $servico->foto }}" alt="{{ $servico->nome }}">
                                    </figure>
                                </a>

                                @foreach ($servico->fotos as $servicoFoto)
                                    <a href="{{ $servicoFoto->foto }}" class="swiper-slide" data-fancybox="{{ $servico->nome }}">
                                        <figure>
                                            <img src="{{ $servicoFoto->foto }}" alt="{{ $servico->nome }}">
                                        </figure>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <figure class="flex">
                                        <img src="{{ $servico->foto_thumb }}" alt="{{ $servico->nome }}">
                                    </figure>
                                </div>

                                @foreach ($servico->fotos as $servicoFoto)
                                    <div class="swiper-slide">
                                        <figure class="flex">
                                            <img src="{{ $servicoFoto->foto_thumb }}" alt="{{ $servico->nome }}">
                                        </figure>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex_c e_input servicosTexto">
                    {!! $servico->texto !!}

                    <div class="flex_c faleServicos">
                        <h2 class="blackFont bold main-t margin30 index2">
                            Fale<br> Conosco
                        </h2>

                        <a href="javascript:;" class="flex middle gap20 whiteFont semibold btnContato zoomEfct index2">
                            <figure class="whFitImg">
                                <img src="{{ @vite::asset('resources/assets/site/img/mailIcon.png') }}" alt="E-mail Icone">
                            </figure>
                            Entrar em Contato
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@section('pageScripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>

    <script>
        //Inicio de FancyBox
        Fancybox.bind("[data-fancybox]", {
            Images: {
                initialSize: "fit",
                Panzoom: {
                    maxScale: 2,
                },
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
            const thumbs = new Swiper('.gallery-thumbs', {
                slidesPerView: 4,
                spaceBetween: 10,
                watchSlidesProgress: true,
                breakpoints: {
                    550: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                },
            });

            const gallerySlider = new Swiper('.gallery-slider', {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                thumbs: {
                    swiper: thumbs,
                },
            });
        });
    </script>
@endsection
