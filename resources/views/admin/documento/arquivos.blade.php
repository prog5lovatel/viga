@extends('admin.layout.base')

@section('titulo', 'Documento')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i>Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.documento') }}">Documento</a></li>
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
                    <a class="nav-link" href="{{ route('admin.documento.edit', ['documento' => $documento->id]) }}">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:;">Arquivos</a>
                </li>
            </ul>

            <h4>Arquivo</h4>

            <hr />

            <div>
                @if (!empty($documento->arquivo))
                    <a href="{{ $documento->arquivo }}" target="_blank" class="btn btn-primary">clique aqui para visualizar</a>
                @endif
            </div>

            <hr />

            <form class="row g-3" action="{{ route('admin.documento.updateArquivos', ['documento' => $documento->id]) }}" onsubmit="crudHelper.Alterar(event, this)">

                <div class="form-group col-md-6">
                    <label for="arquivo" class="form-label">Arquivo ( pdf )</label>
                    <input id="arquivo" class="form-control" type="file" name="arquivo">
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
                    <button type="button" class="btn btn-secondary btn-lg mx-1"
                        onclick="javascript:history.back()">Voltar</button>
                </div>
            </form>
        </div>
    </div>
@endsection


