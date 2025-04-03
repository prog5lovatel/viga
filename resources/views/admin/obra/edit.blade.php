@extends('admin.layout.base')

@section('titulo', 'Obra')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i>Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.obra') }}">Obra</a></li>
    <li class="breadcrumb-item active">Editar</li>

@endsection

@section('conteudo')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Editar</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="javascript:;">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.obra.fotos', ['obra' => $obra->id]) }}">Fotos</a>
                </li>
            </ul>

            <form class="row g-3" action="{{ route('admin.obra.update', ['obra' => $obra->id]) }}" onsubmit="crudHelper.Alterar(event, this)">

                <div class="form-group col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input id="nome" class="form-control" type="text" name="nome" value="{{ $obra->nome }}" maxlength="255">
                </div>

                <div class="form-group col-md-12">
                    <label for="texto" class="form-label">Texto</label>
                    <textarea id="texto" class="form-control" rows="10" name="texto">{{ $obra->texto }}</textarea>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button id="botao-enviando" class="btn btn-primary" type="button" disabled="" style="display:none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Enviando...
                    </button>
                    <button id="botao-alterar" type="submit" class="btn btn-primary btn-lg mx-1">Alterar</button>
                    <button type="button" class="btn btn-secondary btn-lg mx-1" onclick="javascript:history.back()">Voltar</button>
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
				'bold'
            ]);
        });
    </script>
@endsection
