<footer class="footer flex_c">
    <div class="infoFooter container">
        <div class="main flex_w flex_r middle">
            <div class="unidadesFooter flex_c gap40">
                <div class="itemUnidades flex gap20">
                    <figure class="whFitImg">
                        <img src="{{ @Vite::asset('resources/assets/site/img/pinIcon.png') }}" alt="Pin Icone">
                    </figure>
                    <div class="flex_c">
                        <h2 class="yellowFont bold med-t margin10">Comercial</h2>
                        <p>Rua Santos Dumont - 1090, Herval D'Oeste - SC, 89610-000</p>
                        <a href="mailto:recepcao@vigapavimentacoes.com.br" class="whiteFont margin10">recepcao@vigapavimentacoes.com.br</a>
                        <p>(49) 3522-6507</p>
                    </div>
                </div>
                <div class="itemUnidades flex gap20">
                    <figure class="whFitImg">
                        <img src="{{ @Vite::asset('resources/assets/site/img/pinIcon.png') }}" alt="Pin Icone">
                    </figure>
                    <div class="flex_c">
                        <h2 class="yellowFont bold med-t margin10">Comercial</h2>
                        <p>Rua Santos Dumont - 1090, Herval D'Oeste - SC, 89610-000</p>
                        <a href="mailto:recepcao@vigapavimentacoes.com.br" class="whiteFont margin10">recepcao@vigapavimentacoes.com.br</a>
                        <p>(49) 3522-6507</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('home') }}" class="logoF whFitImg flex">
                <img src="{{ @Vite::asset('resources/assets/site/img/logoF.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}">
            </a>
        </div>
    </div>

    <div class="copyright">
        <div class="main flex_w flex_r middle">
            <p>Todos os direitos reservados - <a href="admin" target="_blank">Acesso Restrito</a> - <a
                    href="https://webmail.lovatel.com.br" target="_blank">Webmail</a> - Feito por <a href="https://lovatel.com.br" target="_blank">Lovatel</a></p>
        </div>
    </div>
</footer>

{{-- WhatsApp flutuante --}}
<a href="javascript:;" class="whatsFlutuante flex middle"
    onclick="funcoesHelper.sendWhatsapp('{{ $site->whatsapp }}', 'Olá, tudo bem? Estava navegando no site {{ config('app.name') }} e gostaria de mais informações.')">
    <span>Precisa de ajuda?</span>

    <div class="iconWhatsFlutuante">
        <i class="fa-brands fa-whatsapp"></i>
    </div>
</a>
{{-- WhatsApp flutuante --}}

<a href="javascript:;" class="whatsFlutuante flex middle" onclick="funcoesHelper.sendWhatsapp('{{ $site->whatsapp }}', 'Olá, tudo bem? Estava navegando no site {{ config('app.name') }} e gostaria de mais informações.')">
    <span class="showWhats">Podemos Ajudar?</span>

    <div class="iconWhatsFlutuante showWhats pseudoElemento">
        <figure class="whFitImg">
            <img src="{{@Vite::asset('resources/assets/site/img/wppFlutuante.svg')}}" alt="WhatsApp Icon">
        </figure>
    </div>
</a>

<script src="{{ asset('admin-template/extensions/jquery/jquery.min.js') }}"></script>

@vite(['resources/assets/site/js/app.js', 'resources/assets/site/js/jqueryFunctions.js', 'resources/assets/site/js/ckeditor-init.js'])

<!-- Não remover -->
<script src="https://grupolovatel.com.br/api-lgpd/assets/api/js/script.js"></script>
<!-- Não remover -->
<script>
    /* Header fixo */
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        if (scrollTop > 90) {
            $("header").addClass("scroll");
            $("body").addClass("scroll");
        } else {
            $("header").removeClass("scroll");
            $("body").removeClass("scroll");
        }
    });

    /* Header fixo mobile one page */
    $(".dl-menu li").click(function() {
        var destino = $(this).find("a").attr("rel");
        var header = 220;

        $('html, body').animate({
            scrollTop: $("#" + destino).offset().top - header
        }, 800);

        $(".dl-menu li").removeClass("ativo");
        $(this).addClass("ativo");

        $(".mb-menu").removeClass('act');
        $('.hamburger--spin').removeClass('is-active');
        $('#full-menu').removeClass('act');
    });

    /* Scroll section */
    $(".linkSection").click(function() {
        var destino = $(this).attr("rel");
        var header = 220;

        $('html, body').animate({
            scrollTop: $("#" + destino).offset().top - header
        }, 800);
    });
</script>
