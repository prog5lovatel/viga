@extends('admin.layout.base')

@section('titulo', 'Obra')

@section('pageLinks')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css"
        integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

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
                    <a class="nav-link" href="{{ route('admin.obra.edit', ['obra' => $obra->id]) }}">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:;">Fotos</a>
                </li>
            </ul>

            <h4>Foto - Principal</h4>

            <hr />

            <div>
                <img src="{{ $obra->foto_thumb }}" style="max-width: 100%; width: auto; height: auto;" />
            </div>

            <hr />

            <div class="row">
                <div class="col-md-6">
                    <h4>Fotos - Galeria</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    @if(!$obra->fotos->isEmpty())
                    <button type="button" class="btn btn-primary ms-auto" data-rota="{{ route('admin.obra.destroyAllObraFoto', ['obra' => $obra->id]) }}" onclick="crudHelper.Remover(this)">Excluir Galeria</button>
                    @endif
                </div>
            </div>

            <hr />

            <div class="ordenavel row" data-rota="{{ route('admin.obra.orderObraFoto') }}">

                @foreach ($obra->fotos as $obraFoto)
                    <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-12 my-1" data-id="{{ $obraFoto->id }}">
                        <img src="{{ $obraFoto->foto_thumb }}" class="rounded" style="max-width: 100%; width: auto; height: auto; margin-bottom: 5px;" />
                        <button class="handle btn btn-secondary"><i class="bi bi-arrows-move"></i></button>
                        <button class="btn btn-primary"
                            data-rota="{{ route('admin.obra.destroyObraFoto', ['obraFoto' => $obraFoto->id]) }}"
                            onclick="crudHelper.Remover(this)"><i
                                class="bi bi-trash"></i></button>
                    </div>
                @endforeach
            </div>

            <hr />

            <form class="row g-3" action="{{ route('admin.obra.updateFotos', ['obra' => $obra->id]) }}" onsubmit="crudHelper.AlterarArquivos(event, this)">

                <x-admin.cropper.input label="Foto Principal ( jpg, png ) 1260x1020" name="foto" width="630" height="510" />

                <div class="col-md-6">
                    <label for="fotos" class="form-label">Fotos Galeria( jpg, png ) 1260x1020</label>
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

    <x-admin.cropper.modal />
@endsection

@section('pageScripts')
    @vite(['resources/assets/admin/js/cropperInput.js'])
@endsection
