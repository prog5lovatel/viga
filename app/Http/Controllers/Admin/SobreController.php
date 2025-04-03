<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreateEvent;
use App\Events\UserDestroyEvent;
use App\Events\UserUpdateEvent;
use App\Events\UserUpdateOrderEvent;
use App\Http\Requests\Sobre\SobreFotosRequest;
use App\Http\Requests\Sobre\SobreStoreRequest;
use App\Http\Requests\Sobre\SobreUpdateRequest;
use App\Models\Sobre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SobreFoto;
use App\Traits\ImageTrait;
use App\Traits\UploadTrait;

class SobreController extends Controller
{
    use UploadTrait, ImageTrait;

    private const POR_PAGINA = 10;

    private const CAMINHOS = [
        'FOTOS' => 'fotos_sobre',
        'THUMBS' => 'fotos_sobre/thumbs'
    ];

    private const GALERIA_THUMB = [
        'LARGURA' => 830,
        'ALTURA' => 680
    ];

    /* Views */

    public function edit(Sobre $sobre)
    {
        $ViewData['sobre'] = $sobre;

        return view('admin.sobre.edit', $ViewData);
    }

    public function fotos(Sobre $sobre)
    {
        $ViewData['sobre'] = $sobre;

        return view('admin.sobre.fotos', $ViewData);
    }

    /* Data */

     public function update(SobreUpdateRequest $request, Sobre $sobre)
    {
        $sobre->update($request->validated());

        event(new UserUpdateEvent($sobre));

        return response()->json(['mensagem' => "Registro de Sobre alterado."], 200);
    }

    public function updateFotos(SobreFotosRequest $request, Sobre $sobre)
    {

        $this->storeSobreFoto($request, $sobre);

        return response()->json(['mensagem' => "Fotos alteradas"], 200);
    }

    public function orderSobreFoto(Request $request)
    {
        foreach ($request->ordem as $posicao => $id) {

            SobreFoto::query()->where('sobre_fotos.id', $id)->update(['ordem' => $posicao]);
        }

        event(new UserUpdateOrderEvent(new SobreFoto()));

        return response()->json([
            'tipo' => "success"
        ], 200);
    }

    public function destroyAllSobreFoto(Sobre $sobre)
    {
        foreach ($sobre->fotos as $sobreFoto) {
            deleteFile($sobreFoto->foto);
            deleteFile($sobreFoto->foto_thumb);
        }

        $sobre->fotos()->delete();

        event(new UserDestroyEvent($sobre));

        return response()->json(['mensagem' => "Fotos removidas."], 200);
    }

    public function destroySobreFoto(SobreFoto $sobreFoto)
    {
        deleteFile($sobreFoto->foto);
        deleteFile($sobreFoto->foto_thumb);

        $sobreFoto->delete();

        event(new UserDestroyEvent($sobreFoto));

        return response()->json(['mensagem' => "Foto removida."], 200);
    }

    private function storeSobreFoto($request, $sobre): void
    {
        if(!$request->hasFile('fotos')){
            return;
        }

        foreach ($request->file('fotos') as $file){

            $foto = $this->upload($file, self::CAMINHOS['FOTOS']);

            $this->resize($foto);

            $foto_thumb = $this->upload($file, self::CAMINHOS['THUMBS']);

            $this->resizeFit($foto_thumb, self::GALERIA_THUMB['LARGURA'], self::GALERIA_THUMB['ALTURA']);

            $sobreFoto = $sobre->fotos()->create([
                'foto' => $foto,
                'foto_thumb' => $foto_thumb
            ]);

            event(new UserCreateEvent($sobreFoto));
        }
    }
}
