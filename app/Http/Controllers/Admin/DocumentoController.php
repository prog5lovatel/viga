<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreateEvent;
use App\Events\UserDestroyEvent;
use App\Events\UserUpdateEvent;
use App\Events\UserUpdateOrderEvent;
use App\Http\Requests\Documento\DocumentoStoreRequest;
use App\Http\Requests\Documento\DocumentoUpdateRequest;
use App\Http\Requests\Documento\DocumentoArquivoRequest;
use App\Models\Documento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;

class DocumentoController extends Controller
{
    use UploadTrait;

    private const POR_PAGINA = 10;

    private const CAMINHOS = [
        'ARQUIVOS' => 'arquivos_documento'
    ];

    /* Views */
    public function index(Request $request)
    {
        $ViewData['porPagina'] = $request->integer('porPagina', self::POR_PAGINA);
        $ViewData['busca'] = $request->busca ?? "";

        $ViewData['documentos'] = Documento::search($ViewData['busca'])->paginate($ViewData['porPagina'] == -1 ? PHP_INT_MAX : $ViewData['porPagina']);

        return view('admin.documento.list', $ViewData);
    }

    public function create()
    {
        return view('admin.documento.create');
    }

    public function edit(Documento $documento)
    {
        $ViewData['documento'] = $documento;

        return view('admin.documento.edit', $ViewData);
    }


    public function arquivos(Documento $documento)
    {
        $ViewData['documento'] = $documento;

        return view('admin.documento.arquivos', $ViewData);
    }
    /* Data */

    public function store(DocumentoStoreRequest $request)
    {
        $documento = new Documento($request->validated());

        $documento->arquivo = $this->uploadArquivo($request);

        $documento->save();

        event(new UserCreateEvent($documento));

        return response()->json([
            'mensagem' => "Novo registro de Documento cadastrado.",
            'redirecionamento' => route('admin.documento'),
        ], 201);
    }

    public function update(DocumentoUpdateRequest $request, Documento $documento)
    {
        $documento->update($request->validated());

        event(new UserUpdateEvent($documento));

        return response()->json(['mensagem' => "Registro de Documento alterado."], 200);
    }

    public function updateArquivos(DocumentoArquivoRequest $request, Documento $documento)
    {
        $arquivo = $this->uploadArquivo($request);

        if(!empty($arquivo)){

            deleteFile($documento->arquivo);

            $documento->update(['arquivo' => $arquivo]);

            event(new UserUpdateEvent($documento));
        }

        return response()->json(['mensagem' => "Arquivo alterada."], 200);
    }

    public function order(Request $request)
    {
        foreach ($request->ordem as $posicao => $id) {

            Documento::query()->where('documentos.id', $id)->update(['ordem' => $posicao]);
        }

        event(new UserUpdateOrderEvent(new Documento()));

        return response()->json(['mensagem' => "Ordem de Documento alterada."], 200);
    }

    public function destroy(Documento $documento)
    {
        deleteFile($documento->arquivo);

        $documento->delete();

        event(new UserDestroyEvent($documento));

        return response()->json(['mensagem' => "Registro de Documento removido."], 200);
    }

    private function uploadArquivo($request)
    {
        if(!$request->hasFile('arquivo')){
            return null;
        }

        return $this->upload($request->file('arquivo'), self::CAMINHOS['ARQUIVOS']);
    }
}
