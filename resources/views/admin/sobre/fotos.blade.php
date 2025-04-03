@extends('admin.layout.base')

@section('titulo', 'Sobre')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i>Início</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.sobre.edit',['sobre'=>1]) }}">Sobre</a></li>
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
                    <a class="nav-link" href="{{ route('admin.sobre.edit', ['sobre' => $sobre->id]) }}">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:;">Fotos</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-6">
                    <h4>Fotos - Galeria</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    @if(!$sobre->fotos->isEmpty())
                    <button type="button" class="btn btn-primary ms-auto" data-rota="{{ route('admin.sobre.destroyAllSobreFoto', ['sobre' => $sobre->id]) }}" onclick="crudHelper.Remover(this)">Excluir Galeria</button>
                    @endif
                </div>
            </div>

            <hr />

            <div class="ordenavel row" data-rota="{{ route('admin.sobre.orderSobreFoto') }}">

                @foreach ($sobre->fotos as $sobreFoto)
                    <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-12 my-1" data-id="{{ $sobreFoto->id }}">
                        <img src="{{ $sobreFoto->foto_thumb }}" class="rounded" style="max-width: 100%; width: auto; height: auto; margin-bottom: 5px;" />
                        <button class="handle btn btn-secondary"><i class="bi bi-arrows-move"></i></button>
                        <button class="btn btn-primary"
                            data-rota="{{ route('admin.sobre.destroySobreFoto', ['sobreFoto' => $sobreFoto->id]) }}"
                            onclick="crudHelper.Remover(this)"><i
                                class="bi bi-trash"></i></button>
                    </div>
                @endforeach
            </div>

            <hr />

            <form class="row g-3" action="{{ route('admin.sobre.updateFotos', ['sobre' => $sobre->id]) }}" onsubmit="crudHelper.AlterarArquivos(event, this)">

                <div class="col-md-6">
                    <label for="fotos" class="form-label">Fotos Galeria( jpg, png ) 830x680</label>
                    <input id="fotos" class="form-control" type="file" name="fotos[]" multiple>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12">
                    <div class="progress progress-primary progress-sm  mb-4" style="display: none;">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
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

