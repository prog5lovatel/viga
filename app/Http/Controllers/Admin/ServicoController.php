<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreateEvent;
use App\Events\UserDestroyEvent;
use App\Events\UserUpdateEvent;
use App\Events\UserUpdateOrderEvent;
use App\Http\Requests\Servico\ServicoFotosRequest;
use App\Http\Requests\Servico\ServicoStoreRequest;
use App\Http\Requests\Servico\ServicoUpdateRequest;
use App\Models\Servico;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServicoFoto;
use App\Traits\ImageTrait;
use App\Traits\UploadTrait;

class ServicoController extends Controller
{
    use UploadTrait, ImageTrait;

    private const POR_PAGINA = 10;

    private const CAMINHOS = [
        'FOTOS' => 'fotos_servico',
        'THUMBS' => 'fotos_servico/thumbs'
    ];

    private const FOTO_THUMB = [
        'LARGURA' => 415,
        'ALTURA' => 340
    ];

    private const GALERIA_THUMB = [
        'LARGURA' => 415,
        'ALTURA' => 340
    ];

    /* Views */
    public function index(Request $request)
    {
        $ViewData['porPagina'] = $request->integer('porPagina', self::POR_PAGINA);
        $ViewData['busca'] = $request->busca ?? "";

        $ViewData['servicos'] = Servico::search($ViewData['busca'])->paginate($ViewData['porPagina'] == -1 ? PHP_INT_MAX : $ViewData['porPagina']);

        return view('admin.servico.list', $ViewData);
    }

    public function create()
    {
        return view('admin.servico.create');
    }

    public function edit(Servico $servico)
    {
        $ViewData['servico'] = $servico;

        return view('admin.servico.edit', $ViewData);
    }

    public function fotos(Servico $servico)
    {
        $ViewData['servico'] = $servico;

        return view('admin.servico.fotos', $ViewData);
    }

    /* Data */

    public function store(ServicoStoreRequest $request)
    {
        $servico = new Servico($request->validated());

        $servico->foto = $this->uploadFoto($request);
        $servico->foto_thumb = $this->uploadFotoThumb($request);

        $servico->save();

        $this->storeServicoFoto($request, $servico);

        event(new UserCreateEvent($servico));

        return response()->json([
            'mensagem' => "Registro de Servico cadastrado.",
            'redirecionamento' => route('admin.servico')
        ], 201);
    }

    public function update(ServicoUpdateRequest $request, Servico $servico)
    {
        $servico->update($request->validated());

        event(new UserUpdateEvent($servico));

        return response()->json(['mensagem' => "Registro de Servico alterado."], 200);
    }

    public function updateFotos(ServicoFotosRequest $request, Servico $servico)
    {
        $foto = $this->uploadFoto($request);
        $foto_thumb = $this->uploadFotoThumb($request);

        if(!empty($foto) && !empty($foto_thumb)){

            deleteFile($servico->foto);
            deleteFile($servico->foto_thumb);

            $servico->update([
                'foto' => $foto,
                'foto_thumb' => $foto_thumb
            ]);

            event(new UserUpdateEvent($servico));
        }

        $this->storeServicoFoto($request, $servico);

        return response()->json(['mensagem' => "Fotos alteradas"], 200);
    }

    public function order(Request $request)
    {
        foreach ($request->ordem as $posicao => $id) {

            Servico::query()->where('servicos.id', $id)->update(['ordem' => $posicao]);
        }

        event(new UserUpdateOrderEvent(new Servico()));

        return response()->json(['mensagem' => "Ordem de Servico alterada."], 200);
    }

    public function orderServicoFoto(Request $request)
    {
        foreach ($request->ordem as $posicao => $id) {

            ServicoFoto::query()->where('servicos_fotos.id', $id)->update(['ordem' => $posicao]);
        }

        event(new UserUpdateOrderEvent(new ServicoFoto()));

        return response()->json([
            'tipo' => "success"
        ], 200);
    }

    public function destroyAllServicoFoto(Servico $servico)
    {
        foreach ($servico->fotos as $servicoFoto) {
            deleteFile($servicoFoto->foto);
            deleteFile($servicoFoto->foto_thumb);
        }

        $servico->fotos()->delete();

        event(new UserDestroyEvent($servico));

        return response()->json(['mensagem' => "Fotos removidas."], 200);
    }

    public function destroyServicoFoto(ServicoFoto $servicoFoto)
    {
        deleteFile($servicoFoto->foto);
        deleteFile($servicoFoto->foto_thumb);

        $servicoFoto->delete();

        event(new UserDestroyEvent($servicoFoto));

        return response()->json(['mensagem' => "Foto removida."], 200);
    }

    public function destroy(Servico $servico)
    {
        deleteFile($servico->foto);
        deleteFile($servico->foto_thumb);

        foreach ($servico->fotos as $servicoFoto){
            deleteFile($servicoFoto->foto);
            deleteFile($servicoFoto->foto_thumb);
        }

        $servico->delete();

        event(new UserDestroyEvent($servico));

        return response()->json(['mensagem' => "Registro de Servico removido."], 200);
    }

    private function uploadFoto($request)
    {
        if(!$request->hasFile('foto')){
            return null;
        }

        $foto = $this->upload($request->file('foto'), self::CAMINHOS['FOTOS']);

        $this->resize($foto);

        return $foto;
    }

    private function uploadFotoThumb($request)
    {
        if(!$request->hasFile('foto')){
            return null;
        }

        $foto = $this->upload($request->file('foto'), self::CAMINHOS['THUMBS']);

        $this->crop(
            $foto,
            $request->foto_x,
            $request->foto_y,
            $request->foto_width,
            $request->foto_height
        );

        $this->resize($foto, self::FOTO_THUMB['LARGURA'], self::FOTO_THUMB['ALTURA']);

        return $foto;
    }

    private function storeServicoFoto($request, $servico): void
    {
        if(!$request->hasFile('fotos')){
            return;
        }

        foreach ($request->file('fotos') as $file){

            $foto = $this->upload($file, self::CAMINHOS['FOTOS']);

            $this->resize($foto);

            $foto_thumb = $this->upload($file, self::CAMINHOS['THUMBS']);

            $this->resizeFit($foto_thumb, self::GALERIA_THUMB['LARGURA'], self::GALERIA_THUMB['ALTURA']);

            $servicoFoto = $servico->fotos()->create([
                'foto' => $foto,
                'foto_thumb' => $foto_thumb
            ]);

            event(new UserCreateEvent($servicoFoto));
        }
    }
}
