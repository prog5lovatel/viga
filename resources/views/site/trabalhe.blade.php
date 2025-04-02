@extends('site.layouts.base')

@section('title', 'Quem Somos - ' . config('app.name'))

@section('conteudo')

    <section class="sectionTopoInternas">
        <img src="{{ @Vite::asset('resources/assets/site/img/topoTrabalhe.png') }}" alt="Trabalhe">
        <div class="sobreInternas main flex_c">
            <h1 class="main-t whiteFont bold margin10">Trabalhe Conosco</h1>
            <span class="flex lineYellow"></span>
        </div>
    </section>
    <main class="mainOuvidoria">
        <section class="sectionOuvidoria container">
            <div class="main flex_c margin100">
                <p>Se você é um profissional qualificado e deseja fazer parte da nossa equipe, envie seu currículo por meio do formulário abaixo. Na VIGA Pavimentação e Obras, estamos sempre em busca de novos talentos que compartilhem dos nossos valores de qualidade, ética e compromisso com o trabalho bem-feito.</p>

                <div class="grid2 gap10 btnsTrabalhe">
                    <a href="javascript:;" class="flex middle gap20 whiteFont semibold btnContato">
                        <figure class="whFitImg">
                            <img src="{{ @vite::asset('resources/assets/site/img/mailIcon.png') }}" alt="E-mail Icone">
                        </figure>
                        Entrar em Contato
                    </a>

                    <a href="javascript:;" class="flex middle linkSection gap20 blackFont semibold btnYellow" rel="vagas">
                        <figure class="whFitImg">
                            <img src="{{ @vite::asset('resources/assets/site/img/vagasIcon.png') }}" alt="Vagas Icone">
                        </figure>
                        Vagas Disponíveis
                    </a>
                </div>

                <div class="formulario flex">
                    <form id="form_contact" class="flex_r flex_w" action="{{ route('contato.enviar') }}" ajax-form>

                        <div class="flex_c e_input">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" class="input">

                            <label for="vaga">Vaga de Interesse:</label>
                            <select id="vaga" name="vaga" class="input" required>
                                <option value=""></option>
                                <option value="vaga">Listar as vagas</option>
                            </select>

                        </div>

                        <div class="flex_c e_input">
                            <label for="nome">Telefone:</label>
                            <input type="tel" name="telefone" id="telefone" class="input" maxlength="15">

                            <label for="anexo">Anexos:</label>
                            <label class="labelAnexo fullW flex">
                                <span>PDF, Doc, JPG</span>
                                <input type="file" name="arquivo" id="inputFile">
                            </label>
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

        <section id="vagas" class="sectionVagas container">
            <div class="main flex_c">
                <h2 class="main-t blackFont bold t-center center margin10 uppercase">
                    Vagas Disponíveis
                </h2>
                <span class="flex center lineYellow margin50"></span>
                @for ($s = 0; $s < 5; $s++)
                <div class="itemVagas flex_c margin40">
                    <div class="flex gap20 middle margin10">
                        <figure class="whFitImg">
                            <img src="{{ @Vite::asset('resources/assets/site/img/vagaIcon.png') }}" alt="Vaga Icone">
                        </figure>
                        <h3 class="blackFont med-t bold">Nome da vaga</h3>
                    </div>
                    <div class="flex_c textoVagas">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at consectetur velit. Nulla facilisi. Nulla facilisi. Nulla facilisi.</p>
                        <ul>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, impedit?</li>
                        </ul>
                    </div>
                </div>
                @endfor
            </div>
        </section>
    </main>

@endsection

@section('pageScripts')
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script>
        $('#telefone').mask('(00) 00000-0000');

        document.addEventListener('DOMContentLoaded', () => {
            const inputFile = document.querySelector('#inputFile');
            const labelSpan = document.querySelector('.labelAnexo span');

            inputFile.addEventListener('change', (event) => {
                const fileName = event.target.files[0]?.name || 'PDF, Doc, JPG';
                labelSpan.textContent = fileName;
            });
        });
    </script>
@endsection
