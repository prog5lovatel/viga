@extends('admin.layout.base')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('titulo', 'Unidade')

@section('caminho')
    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item active">Unidade</li>
@endsection

@section('conteudo')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Listagem</h4>
            <button class="btn btn-primary" type="button" onclick="window.location.href='{{ route('admin.unidade.create') }}'">Novo Unidade</button>
        </div>
        <div class="card-body">

            @include('admin.layout.includes.busca', [
                'rota' => route('admin.unidade'),
                'porPagina' => isset($porPagina) ? $porPagina : null,
                'busca' => isset($busca) ? $busca : null,
            ])

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody class="ordenavel" data-rota="{{ route('admin.unidade.order') }}">
                        @foreach ($unidades as $unidade)
                            <tr data-id="{{ $unidade->id }}">
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="handle btn btn-secondary"><i class="bi bi-arrows-move"></i></button>
                                        <a href="{{ route('admin.unidade.edit', ['unidade' => $unidade->id]) }}"
                                            class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <button type="button" class="btn btn-danger" onclick="crudHelper.Remover(this)"
                                            data-rota="{{ route('admin.unidade.destroy', ['unidade' => $unidade->id]) }}"><i
                                                class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                                <td>{{ $unidade->nome }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav class="d-flex justify-content-end">
                {{ $unidades->appends([
                        'busca' => isset($busca) ? $busca : null,
                        'porPagina' => isset($porPagina) && $porPagina != 10 ? $porPagina : null,
                    ])->links() }}
            </nav>
        </div>
    </div>
@endsection
