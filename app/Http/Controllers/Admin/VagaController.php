<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreateEvent;
use App\Events\UserDestroyEvent;
use App\Events\UserUpdateEvent;
use App\Http\Requests\Vaga\VagaStoreRequest;
use App\Http\Requests\Vaga\VagaUpdateRequest;
use App\Models\Vaga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VagaController extends Controller
{
    private const POR_PAGINA = 10;

    /* Views */
    public function index(Request $request)
    {
        $ViewData['porPagina'] = $request->integer('porPagina', self::POR_PAGINA);
        $ViewData['busca'] = $request->busca ?? "";

        $ViewData['vagas'] = Vaga::search($ViewData['busca'])->paginate($ViewData['porPagina'] == -1 ? PHP_INT_MAX : $ViewData['porPagina']);

        return view('admin.vaga.list', $ViewData);
    }

    public function create()
    {
        return view('admin.vaga.create');
    }

    public function edit(Vaga $vaga)
    {
        $ViewData['vaga'] = $vaga;

        return view('admin.vaga.edit', $ViewData);
    }

    /* Data */

    public function store(VagaStoreRequest $request)
    {
        $vaga = new Vaga($request->validated());

        $vaga->save();

        event(new UserCreateEvent($vaga));

        return response()->json([
            'mensagem' => "Novo registro de Vaga cadastrado.",
            'redirecionamento' => route('admin.vaga'),
        ], 201);
    }

    public function update(VagaUpdateRequest $request, Vaga $vaga)
    {
        $vaga->update($request->validated());

        event(new UserUpdateEvent($vaga));

        return response()->json(['mensagem' => "Registro de Vaga alterado."], 200);
    }

    public function destroy(Vaga $vaga)
    {
        $vaga->delete();

        event(new UserDestroyEvent($vaga));

        return response()->json(['mensagem' => "Registro de Vaga removido."], 200);
    }

}
