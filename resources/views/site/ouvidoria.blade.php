@extends('site.layouts.base')

@section('title', 'Quem Somos - ' . config('app.name'))

@section('conteudo')

    <section class="sectionTopoInternas">
        <img src="{{ @Vite::asset('resources/assets/site/img/topoOuvidoria.png') }}" alt="Ouvidoria">
        <div class="sobreInternas main flex_c">
            <h1 class="main-t whiteFont bold margin10">Ouvidoria</h1>
            <span class="flex lineYellow"></span>
        </div>
    </section>
    <main class="mainOuvidoria">
        <section class="sectionOuvidoria container">
            <div class="main flex_c margin100">
                <p>Estamos sempre à disposição para ouvir sugestões, críticas e denúncias, visando melhorar nossos processos e serviços. A Viga Pavimentação Asfáltica preza pela transparência e pelo respeito em todas as suas ações.</p>

                <div class="formulario flex">
                    <form id="form_contact" class="flex_r flex_w" action="{{ route('contato.enviar') }}" ajax-form>

                        <div class="flex_c e_input">
                            <label for="nome">Nome: (opcional)</label>
                            <input type="text" name="nome" class="input">

                            <label for="relacao">Relação com a empresa:</label>
                            <select id="relacao" name="relacao" class="input" required>
                                <option value=""></option>
                                <option value="colaborador">Colaborador</option>
                                <option value="fornecedor">Fornecedor</option>
                                <option value="cliente">Cliente</option>
                                <option value="outro">Outro</option>
                            </select>

                        </div>

                        <div class="flex_c e_input">
                            <label for="nome">Telefone: (opcional)</label>
                            <input type="tel" name="telefone" id="telefone" class="input" maxlength="15">

                            <label for="anexo">Anexos:</label>
                            <label class="labelAnexo fullW flex">
                                <span>PDF, Doc, JPG</span>
                                <input type="file" name="arquivo" id="inputFile">
                            </label>
                        </div>

                        <label for="denucia">Descrição da denúncia:</label>
                        <textarea name="denucia" class="input msg" required></textarea>
                        <span class="small-t">Estou de acordo com as <a href="javascript:;" class="blackFont bold underline"> políticas de denúncias</a></span>
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
