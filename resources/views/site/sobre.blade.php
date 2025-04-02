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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis architecto aliquid at molestias, accusamus quo eaque deserunt corporis! Asperiores dolorum non accusamus deserunt dolores beatae, consequuntur quam fuga ducimus voluptates veritatis ad, eligendi vel eaque excepturi nulla animi vitae molestias esse placeat reprehenderit perspiciatis provident, quos a? Neque ad nam dicta molestiae dolores reprehenderit, esse recusandae perspiciatis illo molestias minus unde aliquid impedit blanditiis voluptas cum nostrum corporis eligendi amet beatae tenetur dolorum? Ea assumenda nobis libero magnam voluptatum repudiandae. Dignissimos commodi impedit voluptate inventore in odio voluptas sed tenetur architecto neque quibusdam repellendus, quo asperiores, repellat quis eum fuga!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis architecto aliquid at molestias, accusamus quo eaque deserunt corporis! Asperiores dolorum non accusamus deserunt dolores beatae, consequuntur quam fuga ducimus voluptates veritatis ad, eligendi vel eaque excepturi nulla animi vitae molestias esse placeat reprehenderit perspiciatis provident, quos a? Neque ad nam dicta molestiae dolores reprehenderit, esse recusandae perspiciatis illo molestias minus unde aliquid impedit blanditiis voluptas cum nostrum corporis eligendi amet beatae tenetur dolorum? Ea assumenda nobis libero magnam voluptatum repudiandae. Dignissimos commodi impedit voluptate inventore in odio voluptas sed tenetur architecto neque quibusdam repellendus, quo asperiores, repellat quis eum fuga!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis architecto aliquid at molestias, accusamus quo eaque deserunt corporis! Asperiores dolorum non accusamus deserunt dolores beatae, consequuntur quam fuga ducimus voluptates veritatis ad, eligendi vel eaque excepturi nulla animi vitae molestias esse placeat reprehenderit perspiciatis provident, quos a? Neque ad nam dicta molestiae dolores reprehenderit, esse recusandae perspiciatis illo molestias minus unde aliquid impedit blanditiis voluptas cum nostrum corporis eligendi amet beatae tenetur dolorum? Ea assumenda nobis libero magnam voluptatum repudiandae. Dignissimos commodi impedit voluptate inventore in odio voluptas sed tenetur architecto neque quibusdam repellendus, quo asperiores, repellat quis eum fuga!</p>

                <section class="slidesGaleriaSobre fullW">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @for ($s = 0; $s < 5; $s++)
                                <a href="https://dummyimage.com/830x680/" class="swiper-slide" data-fancybox="foto">
                                    <img src="https://dummyimage.com/830x680/">
                                </a>
                            @endfor
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
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis animi eligendi sed exercitationem quibusdam delectus!
                            </p>
                        </div>
                        <div class="visao flex_c">
                            <h4 class="sub-t blackFont margin10 bold ">Visão</h4>
                            <span class="flex lineYellow margin20   "></span>
                            <p>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis animi eligendi sed exercitationem quibusdam delectus!
                            </p>
                        </div>
                    </div>

                    <div class="valores flex_c">
                        <h4 class="sub-t blackFont bold margin10 index2">Valores</h4>
                        <span class="flex lineBlack margin20 index2"></span>
                        <p>Ética e Integridade:<br>
                            Conduzir todos os negócios com honestidade, transparência e respeito às leis, promovendo relações justas e de confiança com clientes, fornecedores e colaboradores.<br>

                            Sustentabilidade:<br>
                            Atuar de forma responsável com o meio ambiente, buscando sempre práticas que minimizem impactos e promovam o desenvolvimento sustentável.<br>

                            Excelência Operacional:<br>
                            Buscar constantemente a melhoria dos processos e a excelência na execução das obras, garantindo a satisfação dos clientes e a segurança de todos.<br>

                            Respeito e Valorização das Pessoas:<br>
                            Tratar todos com respeito e dignidade, criando um ambiente de trabalho seguro, inclusivo e acolhedor.<br>

                            Compromisso Social:<br>
                            Contribuir ativamente para o bem-estar das comunidades onde atuamos, apoiando iniciativas que promovam desenvolvimento social.</p>
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
            loop: true,
            navigation: {
                nextEl: '.slidesGaleriaSobre .swiper-button-next',
                prevEl: '.slidesGaleriaSobre .swiper-button-prev',
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
    </script>
@endsection
