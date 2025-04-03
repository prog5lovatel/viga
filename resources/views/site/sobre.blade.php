@extends('site.layouts.base')

@section('title', 'Quem Somos - ' . config('app.name'))

@section('pageLinks')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/css/swiper.css">
    @vite(['resources/assets/site/css/slides.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
        integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw=="
        crossorigin="anonymous"/>
@endsection
@section('conteudo')

    <section class="sectionTopoInternas">
        <img src="{{ @Vite::asset('resources/assets/site/img/topoQuem.png') }}" alt="Quem Somos">
        <div class="sobreInternas main flex_c">
            <h1 class="main-t whiteFont bold margin10">Quem Somos</h1>
            <span class="flex lineYellow"></span>
        </div>
    </section>
    <main class="mainSobre">
        <section class="sobreSection container">
            <div class="main flex_c">
                {!! $sobre->texto !!}
                <section class="slidesGaleriaSobre fullW">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($sobre->fotos as $sobreFotos)
                                <a href="{{ $sobreFotos->foto }}" class="swiper-slide" data-fancybox="foto">
                                    <img src="{{ $sobreFotos->foto_thumb }}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </section>

            </div>
        </section>



        <section class="sectionMissao container">
            <div class="main flex">
                <div class="gridValores grid2 middle gap40">
                    <div class="grid">
                        <div class="missao flex_c">
                            <h4 class="sub-t blackFont margin10 bold">Missão</h4>
                            <span class="flex lineYellow margin20"></span>
                            {!! $sobre->missao !!}
                        </div>
                        <div class="visao flex_c">
                            <h4 class="sub-t blackFont margin10 bold ">Visão</h4>
                            <span class="flex lineYellow margin20"></span>
                            {!! $sobre->visao !!}
                        </div>
                    </div>

                    <div class="valores flex_c">
                        <h4 class="sub-t blackFont bold margin10 index2">Valores</h4>
                        <span class="flex lineBlack margin20 index2"></span>
                        {!! $sobre->valores !!}
                    </div>

                </div>
            </div>
        </section>
    </main>

@endsection

@section('pageScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
    integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA=="
    crossorigin="anonymous"></script>

    <script>
        var swiperClientes = new Swiper('.slidesGaleriaSobre .swiper-container', {
            slidesPerView: 3,
            spaceBetween: 20,
            slidesPerGroup: 1,
            autoplay: {
                delay: 3000,
                disableOnInteraction: true,
            },
            navigation: {
                nextEl: '.slidesGaleriaSobre .swiper-button-next',
                prevEl: '.slidesGaleriaSobre .swiper-button-prev',
            },
            breakpoints: {
                1150: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    slidesPerGroup: 1,
                },
                780: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    slidesPerGroup: 1,
                }
            }
        });
    </script>
@endsection
