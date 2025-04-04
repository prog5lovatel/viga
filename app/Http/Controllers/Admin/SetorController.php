<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreateEvent;
use App\Events\UserDestroyEvent;
use App\Events\UserUpdateEvent;
use App\Events\UserUpdateOrderEvent;
use App\Http\Requests\Setor\SetorStoreRequest;
use App\Http\Requests\Setor\SetorUpdateRequest;
use App\Models\Setor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SetorController extends Controller
{
    private const POR_PAGINA = 10;

    /* Views */
    public function index(Request $request)
    {
        $ViewData['porPagina'] = $request->integer('porPagina', self::POR_PAGINA);
        $ViewData['busca'] = $request->busca ?? "";

        $ViewData['Setores'] = Setor::search($ViewData['busca'])->paginate($ViewData['porPagina'] == -1 ? PHP_INT_MAX : $ViewData['porPagina']);

        return view('admin.setor.list', $ViewData);
    }

    public function create()
    {
        return view('admin.setor.create');
    }

    public function edit(Setor $setor)
    {
        $ViewData['setor'] = $setor;

        return view('admin.setor.edit', $ViewData);
    }

    /* Data */

    public function store(SetorStoreRequest $request)
    {
        $setor = new Setor($request->validated());

        $setor->save();

        event(new UserCreateEvent($setor));

        return response()->json([
            'mensagem' => "Novo registro de Setor cadastrado.",
            'redirecionamento' => route('admin.setor'),
        ], 201);
    }

    public function update(SetorUpdateRequest $request, Setor $setor)
    {
        $setor->update($request->validated());

        event(new UserUpdateEvent($setor));

        return response()->json(['mensagem' => "Registro de Setor alterado."], 200);
    }


    public function destroy(Setor $setor)
    {
        deleteFile($setor->foto);

        $setor->delete();

        event(new UserDestroyEvent($setor));

        return response()->json(['mensagem' => "Registro de Setor removido."], 200);
    }

}
