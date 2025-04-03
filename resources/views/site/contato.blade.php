@extends('site.layouts.base')

@section('title', 'Quem Somos - ' . config('app.name'))

@section('conteudo')

    <section class="sectionTopoInternas">
        <img src="{{ @Vite::asset('resources/assets/site/img/topoContato.png') }}" alt="Contato">
        <div class="sobreInternas main flex_c">
            <h1 class="main-t whiteFont bold margin10">Contato</h1>
            <span class="flex lineYellow"></span>
        </div>
    </section>
    <main class="mainOuvidoria">
        <section class="sectionOuvidoria container">
            <div class="main flex_c margin100">
                <p>Estamos sempre à disposição para ouvir sugestões, críticas e denúncias, visando melhorar nossos processos e serviços. A VIGA Pavimentação preza pela transparência e pelo respeito em todas as suas ações.</p>

                <div class="grid2 gap10 btnsTrabalhe">
                    <a href="javascript:;" class="flex middle gap20 whiteFont semibold btnContato">
                        <figure class="whFitImg">
                            <img src="{{ @vite::asset('resources/assets/site/img/mailIcon.png') }}" alt="E-mail Icone">
                        </figure>
                        Entrar em Contato
                    </a>

                    <a href="{{ route('ouvidoria') }}" class="flex middle gap20 blackFont semibold btnYellow">
                        <figure class="whFitImg">
                            <img src="{{ @vite::asset('resources/assets/site/img/ouvidoriaIcon.png') }}" alt="Vagas Icone">
                        </figure>
                        Ouvidoria
                    </a>
                </div>

                <div class="formulario flex">
                    <form id="form_contact" class="flex_r flex_w" action="{{ route('contato.enviar') }}" ajax-form>

                        <div class="flex_c e_input">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" class="input" required>

                            <label for="nome">Telefone:</label>
                            <input type="tel" name="telefone" id="telefone" class="input" maxlength="15" required>
                        </div>

                        <div class="flex_c e_input">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" class="input" required>

                            <label for="assunto">Assunto:</label>
                            <select id="setor" name="setor" class="input" required>
                                <option value="">Selecione:</option>
                                @foreach ($setores as $setor)
                                <option value="{{ $setor->id }}">{{ $setor->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="mensagem">Mensagem:</label>
                        <textarea name="mensagem" class="input msg" required></textarea>
                        <span class="small-t">Estou de acordo com as <a href="javascript:;" class="blackFont bold underline"> políticas de proteção de dados</a></span>
                        <button type="submit" class="button flex middle gap20 whiteFont semibold">
                            <figure class="whFitImg">
                                <img src="{{ @vite::asset('resources/assets/site/img/mailIcon.png') }}" alt="E-mail Icone">
                            </figure>
                            Entrar em Contato
                        </button>

                    </form>
                </div>

            </div>
        </section>
    </main>

@endsection

@section('pageScripts')
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script>
        $('#telefone').mask('(00) 00000-0000');
    </script>
@endsection
