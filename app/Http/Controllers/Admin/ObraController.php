<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreateEvent;
use App\Events\UserDestroyEvent;
use App\Events\UserUpdateEvent;
use App\Events\UserUpdateOrderEvent;
use App\Http\Requests\Obra\ObraFotosRequest;
use App\Http\Requests\Obra\ObraStoreRequest;
use App\Http\Requests\Obra\ObraUpdateRequest;
use App\Models\Obra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ObraFoto;
use App\Traits\ImageTrait;
use App\Traits\UploadTrait;

class ObraController extends Controller
{
    use UploadTrait, ImageTrait;

    private const POR_PAGINA = 10;

    private const CAMINHOS = [
        'FOTOS' => 'fotos_obra',
        'THUMBS' => 'fotos_obra/thumbs'
    ];

    private const FOTO_THUMB = [
        'LARGURA' => 630,
        'ALTURA' => 510
    ];

    private const GALERIA_THUMB = [
        'LARGURA' => 630,
        'ALTURA' => 510
    ];

    /* Views */
    public function index(Request $request)
    {
        $ViewData['porPagina'] = $request->integer('porPagina', self::POR_PAGINA);
        $ViewData['busca'] = $request->busca ?? "";

        $ViewData['obras'] = Obra::search($ViewData['busca'])->paginate($ViewData['porPagina'] == -1 ? PHP_INT_MAX : $ViewData['porPagina']);

        return view('admin.obra.list', $ViewData);
    }

    public function create()
    {
        return view('admin.obra.create');
    }

    public function edit(Obra $obra)
    {
        $ViewData['obra'] = $obra;

        return view('admin.obra.edit', $ViewData);
    }

    public function fotos(Obra $obra)
    {
        $ViewData['obra'] = $obra;

        return view('admin.obra.fotos', $ViewData);
    }

    /* Data */

    public function store(ObraStoreRequest $request)
    {
        $obra = new Obra($request->validated());

        $obra->foto = $this->uploadFoto($request);
        $obra->foto_thumb = $this->uploadFotoThumb($request);

        $obra->save();

        $this->storeObraFoto($request, $obra);

        event(new UserCreateEvent($obra));

        return response()->json([
            'mensagem' => "Registro de Obra cadastrado.",
            'redirecionamento' => route('admin.obra')
        ], 201);
    }

    public function update(ObraUpdateRequest $request, Obra $obra)
    {
        $obra->update($request->validated());;

        event(new UserUpdateEvent($obra));

        return response()->json(['mensagem' => "Registro de Obra alterado."], 200);
    }

    public function updateFotos(ObraFotosRequest $request, Obra $obra)
    {
        $foto = $this->uploadFoto($request);
        $foto_thumb = $this->uploadFotoThumb($request);

        if(!empty($foto) && !empty($foto_thumb)){

            deleteFile($obra->foto);
            deleteFile($obra->foto_thumb);

            $obra->update([
                'foto' => $foto,
                'foto_thumb' => $foto_thumb
            ]);

            event(new UserUpdateEvent($obra));
        }

        $this->storeObraFoto($request, $obra);

        return response()->json(['mensagem' => "Fotos alteradas"], 200);
    }

    public function order(Request $request)
    {
        foreach ($request->ordem as $posicao => $id) {

            Obra::query()->where('obras.id', $id)->update(['ordem' => $posicao]);
        }

        event(new UserUpdateOrderEvent(new Obra()));

        return response()->json(['mensagem' => "Ordem de Obra alterada."], 200);
    }

    public function orderObraFoto(Request $request)
    {
        foreach ($request->ordem as $posicao => $id) {

            ObraFoto::query()->where('obras_fotos.id', $id)->update(['ordem' => $posicao]);
        }

        event(new UserUpdateOrderEvent(new ObraFoto()));

        return response()->json([
            'tipo' => "success"
        ], 200);
    }

    public function destroyAllObraFoto(Obra $obra)
    {
        foreach ($obra->fotos as $obraFoto) {
            deleteFile($obraFoto->foto);
            deleteFile($obraFoto->foto_thumb);
        }

        $obra->fotos()->delete();

        event(new UserDestroyEvent($obra));

        return response()->json(['mensagem' => "Fotos removidas."], 200);
    }

    public function destroyObraFoto(ObraFoto $obraFoto)
    {
        deleteFile($obraFoto->foto);
        deleteFile($obraFoto->foto_thumb);

        $obraFoto->delete();

        event(new UserDestroyEvent($obraFoto));

        return response()->json(['mensagem' => "Foto removida."], 200);
    }

    public function destroy(Obra $obra)
    {
        deleteFile($obra->foto);
        deleteFile($obra->foto_thumb);

        foreach ($obra->fotos as $obraFoto){
            deleteFile($obraFoto->foto);
            deleteFile($obraFoto->foto_thumb);
        }

        $obra->delete();

        event(new UserDestroyEvent($obra));

        return response()->json(['mensagem' => "Registro de Obra removido."], 200);
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

    private function storeObraFoto($request, $obra): void
    {
        if(!$request->hasFile('fotos')){
            return;
        }

        foreach ($request->file('fotos') as $file){

            $foto = $this->upload($file, self::CAMINHOS['FOTOS']);

            $this->resize($foto);

            $foto_thumb = $this->upload($file, self::CAMINHOS['THUMBS']);

            $this->resizeFit($foto_thumb, self::GALERIA_THUMB['LARGURA'], self::GALERIA_THUMB['ALTURA']);

            $obraFoto = $obra->fotos()->create([
                'foto' => $foto,
                'foto_thumb' => $foto_thumb
            ]);

            event(new UserCreateEvent($obraFoto));
        }
    }
}
