@extends('admin.layout.base')

@section('titulo', 'Vaga')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i>Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.vaga') }}">Vaga</a></li>
    <li class="breadcrumb-item active">Cadastrar</li>

@endsection

@section('conteudo')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cadastrar</h4>
        </div>
        <div class="card-body">
            <form class="row g-3" action="{{ route('admin.vaga.store') }}" onsubmit="crudHelper.Cadastrar(event,this)">

                <div class="form-group col-md-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input id="nome" class="form-control" type="text" name="nome" value="" maxlength="255">
                </div>

                <div class="form-group col-md-12">
                    <label for="texto" class="form-label">Texto</label>
                    <textarea id="texto" class="form-control" rows="10" name="texto"></textarea>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-12">
                    <div class="progress progress-primary progress-sm  mb-4" style="display: none;">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end aling-itens-center">
                    <button id="botao-enviando" class="btn btn-primary" type="button" disabled="" style="display:none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Enviando...
                    </button>
                    <button id="botao-cadastrar" type="submit" class="btn btn-primary btn-lg mx-1">Cadastrar</button>
                    <button type="button" class="btn btn-secondary btn-lg mx-1"
                        onclick="javascript:history.back()">Voltar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    @vite(['resources/assets/admin/js/ckEditorFacade.js'])

    <script>
        $(document).ready(function () {
            CKEditorFacade('[name="texto"]', [
				'bold',
                
            ]);
        });
    </script>
@endsection
