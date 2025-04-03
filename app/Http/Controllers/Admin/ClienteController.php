<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreateEvent;
use App\Events\UserDestroyEvent;
use App\Events\UserUpdateEvent;
use App\Events\UserUpdateOrderEvent;
use App\Http\Requests\Cliente\ClienteFotosRequest;
use App\Http\Requests\Cliente\ClienteStoreRequest;
use App\Http\Requests\Cliente\ClienteUpdateRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use App\Traits\UploadTrait;

class ClienteController extends Controller
{
    use ImageTrait, UploadTrait;

    private const POR_PAGINA = 10;

    private const CAMINHOS = [
        'FOTOS' => 'fotos_cliente'
    ];

    private const FOTO = [
        'LARGURA' => 310,
        'ALTURA' => 170
    ];

    /* Views */
    public function index(Request $request)
    {
        $ViewData['porPagina'] = $request->integer('porPagina', self::POR_PAGINA);
        $ViewData['busca'] = $request->busca ?? "";

        $ViewData['clientes'] = Cliente::search($ViewData['busca'])->paginate($ViewData['porPagina'] == -1 ? PHP_INT_MAX : $ViewData['porPagina']);

        return view('admin.cliente.list', $ViewData);
    }

    public function create()
    {
        return view('admin.cliente.create');
    }

    public function edit(Cliente $cliente)
    {
        $ViewData['cliente'] = $cliente;

        return view('admin.cliente.edit', $ViewData);
    }

    public function fotos(Cliente $cliente)
    {
        $ViewData['cliente'] = $cliente;

        return view('admin.cliente.fotos', $ViewData);
    }

    /* Data */

    public function store(ClienteStoreRequest $request)
    {
        $cliente = new Cliente($request->validated());

        $cliente->foto = $this->uploadFoto($request);

        $cliente->save();

        event(new UserCreateEvent($cliente));

        return response()->json([
            'mensagem' => "Novo registro de Cliente cadastrado.",
            'redirecionamento' => route('admin.cliente'),
        ], 201);
    }

    public function update(ClienteUpdateRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());

        event(new UserUpdateEvent($cliente));

        return response()->json(['mensagem' => "Registro de Cliente alterado."], 200);
    }

    public function updateFotos(ClienteFotosRequest $request, Cliente $cliente)
    {
        $foto = $this->uploadFoto($request);

        if(!empty($foto)){

            deleteFile($cliente->foto);

            $cliente->update(['foto' => $foto]);

            event(new UserUpdateEvent($cliente));
        }

        return response()->json(['mensagem' => "Foto alterada."], 200);
    }

    public function order(Request $request)
    {
        foreach ($request->ordem as $posicao => $id) {

            Cliente::query()->where('clientes.id', $id)->update(['ordem' => $posicao]);
        }

        event(new UserUpdateOrderEvent(new Cliente()));

        return response()->json(['mensagem' => "Ordem de Cliente alterada."], 200);
    }

    public function destroy(Cliente $cliente)
    {
        deleteFile($cliente->foto);

        $cliente->delete();

        event(new UserDestroyEvent($cliente));

        return response()->json(['mensagem' => "Registro de Cliente removido."], 200);
    }

    private function uploadFoto($request)
    {
        if(!$request->hasFile('foto')){
            return null;
        }

        $foto = $this->upload($request->file('foto'), self::CAMINHOS['FOTOS']);

        $this->crop(
            $foto,
            $request->foto_x,
            $request->foto_y,
            $request->foto_width,
            $request->foto_height
        );

        $this->resize($foto, self::FOTO['LARGURA'], self::FOTO['ALTURA']);

        return $foto;
    }
}
