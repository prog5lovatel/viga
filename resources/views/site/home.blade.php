@extends('site.layouts.base')

@section('title', config('app.name'))

@section('pageLinks')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/css/swiper.css">
    @vite(['resources/assets/site/css/slides.css'])
@endsection

@section('conteudo')

    <div id="banner2">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @for ($b = 0; $b < 3; $b++)
                    <a href="javascript:;" class="swiper-slide flex_c">
                        <figure class="bannerDesk flex">
                            <img src="https://dummyimage.com/1920x740/" alt="Banner">
                        </figure>

                        <figure class="bannerMobile flex">
                            <img src="https://dummyimage.com/900x900/" alt="Banner">
                        </figure>

                        <div class="sobreBanner flex middle">
                            <div class="main flex_c">
                                {{-- ADICIONAR SÓ O TEXTO DENTRO DO H2 E DO H3 --}}
                                <h2 class="main-t extrabold blackFont margin40">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem, quis.</h2>

                                <h3 class="small-t blackFont">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quo, eum.</h3>

                            </div>
                        </div>
                    </a>
                @endfor
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <section class="sectionServicos container">
        <div class="main flex_c">
            <h1 class="main-t t-center center blackFont bold margin10">
                NOSSOS SERVIÇOS
            </h1>
            <span class="flex center lineYellow margin30"></span>

            <h3 class="small-t t-center center margin30">Execução de projetos de alta qualidade, sempre alinhados às<br>melhores práticas de engenharia e sustentabilidade.</h3>

            <section class="slidesServicos fullW">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @for ($s = 0; $s < 5; $s++)
                            <a href="javascript:;" class="swiper-slide">
                                <div class="itemServicos flex">
                                    <img src="https://dummyimage.com/830x680/" alt="nome serviço">
                                    <div class="flex_c middle sobreServicos">
                                        <h2 class="med-t whiteFont t-center center bold">
                                            Pavimentação Asfáltica
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        @endfor
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </section>
        </div>
    </section>

    <section class="sectionObrasDestaques container">
        <div class="flex_c main">
            <h2 class="main-t t-center center whiteFont bold margin10">
                OBRAS EM DESTAQUE
            </h2>
            <span class="flex center lineYellow margin30"></span>

            <section class="slidesObras fullW">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @for ($s = 0; $s < 5; $s++)
                            <a href="javascript:;" class="swiper-slide">
                                <div class="itemServicos flex">
                                    <img src="https://dummyimage.com/1260x1020/" alt="nome obra">
                                    <div class="flex_c middle sobreServicos">
                                        <h2 class="med-t whiteFont t-center center bold">
                                            Pavimentação Asfáltica
                                        </h2>
                                    </div>
                                </div>
                            </a>
                        @endfor
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </section>
        </div>
    </section>

    <section class="sectionTrabalheHome container">
        <div class="main grid2 gap40">

            <a href="javascript:;" class="trabalheHome flex_c">
                <h2 class="blackFont sub-t bold margin10">
                    Trabalhe Conosco
                </h2>
                <h3 class="small-t blackFont">
                    Se você é um profissional qualificado e deseja fazer parte da nossa equipe, envie seu currículo
                </h3>
            </a>

            <a href="javascript:;" class="flex_c">
                <h2 class="blackFont sub-t bold margin10">
                    Ouvidoria
                </h2>
                <h3 class="small-t blackFont">
                    Estamos sempre à disposição para ouvir sugestões, críticas e denúncias, visando melhorar nossos processos e serviços.
                </h3>
            </a>
        </div>
    </section>

    <section class="sectionMarcas container" id="marcas">
        <div class="main flex_c">
            <h2 class="blackFont margin30 med-t">
                Alguns clientes:
            </h2>
            <div class="carousel animated">
                <div class="group animated">
                    @for ($s = 0; $s < 5; $s++)
                    <div class="card">
                        <img src="https://dummyimage.com/310x170/">
                    </div>
                    @endfor
                </div>
                <div aria-hidden class="group animated">
                    @for ($s = 0; $s < 5; $s++)
                    <div class="card">
                        <img src="https://dummyimage.com/310x170/">
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    @include('site.includes.modal')

@endsection

@section('pageScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.min.js"></script>
    <script>
        /* Scroll section */
        $(document).ready(function() {
            $(".marcas").click(function() {
                var destino = $(this).find("a").attr("rel");
                deslizarAte(destino);
            });
        });

        function deslizarAte(destino) {
            $('html, body').animate({
                    scrollTop: $("#" + destino).offset().top - 220
            }, 800);
        }

        var getMarcas = function() {
            deslizarAte('marcas');
        }

        $(document).ready(function() {

            const path = window.location.pathname;

            const rotas = [{
                regex: /\/marcas/,
                action: getMarcas
            }, ];

            rotas.forEach(rota => {
                if (rota.regex.test(path)) {
                    rota.action();
                    return;
                }
            });
        });

        // Modelo Banner 2
        var swiper = new Swiper('#banner2 .swiper-container', {
            effect: "fade",
            fadeEffect: {
                crossFade: true,
            },
            loop: true,
            speed: 2000,
            centeredSlides: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '#banner2 .swiper-pagination',
                clickable: true,
            },
            allowTouchMove: false,
        });

        var swiperClientes = new Swiper('.slidesServicos .swiper-container', {
            slidesPerView: 3,
            spaceBetween: 20,
            slidesPerGroup: 1,
            autoplay: {
                delay: 3000,
                disableOnInteraction: true,
            },
            loop: true,
            navigation: {
                nextEl: '.slidesServicos .swiper-button-next',
                prevEl: '.slidesServicos .swiper-button-prev',
            },
            breakpoints: {
                1150: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                    slidesPerGroup: 1,
                },
                780: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    slidesPerGroup: 1,
                },
                420: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    slidesPerGroup: 1,
                },
            },
        });

        var swiperObras = new Swiper('.slidesObras .swiper-container', {
            slidesPerView: 2,
            spaceBetween: 20,
            slidesPerGroup: 1,
            autoplay: {
                delay: 3000,
                disableOnInteraction: true,
            },
            loop: true,
            navigation: {
                nextEl: '.slidesObras .swiper-button-next',
                prevEl: '.slidesObras .swiper-button-prev',
            },
            breakpoints: {
                780: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    slidesPerGroup: 1,
                },
                420: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    slidesPerGroup: 1,
                }
            }
        });


    </script>
@endsection
