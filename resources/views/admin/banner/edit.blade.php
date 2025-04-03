@extends('admin.layout.base')

@section('titulo', 'Banner')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i>Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.banner') }}">Banner</a></li>
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
                    <a class="nav-link" href="{{ route('admin.banner.fotos', ['banner' => $banner->id]) }}">Fotos</a>
                </li>
            </ul>

            <form class="row g-3" action="{{ route('admin.banner.update', ['banner' => $banner->id]) }}" onsubmit="crudHelper.Alterar(event, this)">

                <div class="form-group col-md-6">
                    <label for="titulo" class="form-label">Titulo</label>
                    <input id="titulo" class="form-control" type="text" name="titulo" value="{{ $banner->titulo }}" maxlength="255">
                </div>

                <div class="form-group col-md-6">
                    <label for="subtitulo" class="form-label">Subtitulo</label>
                    <input id="subtitulo" class="form-control" type="text" name="subtitulo" value="{{ $banner->subtitulo }}" maxlength="255">
                </div>

                <div class="form-group col-md-12">
                    <label for="url" class="form-label">Url</label>
                    <input id="url" class="form-control" type="url" name="url" value="{{ $banner->url }}" maxlength="255">
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


