<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreateEvent;
use App\Events\UserDestroyEvent;
use App\Events\UserUpdateEvent;
use App\Events\UserUpdateOrderEvent;
use App\Http\Requests\Unidade\UnidadeStoreRequest;
use App\Http\Requests\Unidade\UnidadeUpdateRequest;
use App\Models\Unidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnidadeController extends Controller
{
    private const POR_PAGINA = 10;

    /* Views */
    public function index(Request $request)
    {
        $ViewData['porPagina'] = $request->integer('porPagina', self::POR_PAGINA);
        $ViewData['busca'] = $request->busca ?? "";

        $ViewData['unidades'] = Unidade::search($ViewData['busca'])->paginate($ViewData['porPagina'] == -1 ? PHP_INT_MAX : $ViewData['porPagina']);

        return view('admin.unidade.list', $ViewData);
    }

    public function create()
    {
        return view('admin.unidade.create');
    }

    public function edit(Unidade $unidade)
    {
        $ViewData['unidade'] = $unidade;

        return view('admin.unidade.edit', $ViewData);
    }

    /* Data */

    public function store(UnidadeStoreRequest $request)
    {
        $unidade = new Unidade($request->validated());

        $unidade->save();

        event(new UserCreateEvent($unidade));

        return response()->json([
            'mensagem' => "Registro de Unidade cadastrado.",
            'redirecionamento' => route('admin.unidade')
        ], 201);
    }

    public function update(UnidadeUpdateRequest $request, Unidade $unidade)
    {
        $unidade->update($request->validated());

        event(new UserUpdateEvent($unidade));

        return response()->json(['mensagem' => "Registro de Unidade alterado."], 200);
    }


    public function order(Request $request)
    {
        foreach ($request->ordem as $posicao => $id) {

            Unidade::query()->where('unidades.id', $id)->update(['ordem' => $posicao]);
        }

        event(new UserUpdateOrderEvent(new Unidade()));

        return response()->json(['mensagem' => "Ordem de Unidade alterada."], 200);
    }

    public function destroy(Unidade $unidade)
    {
        $unidade->delete();

        event(new UserDestroyEvent($unidade));

        return response()->json(['mensagem' => "Registro de Unidade removido."], 200);
    }
}
