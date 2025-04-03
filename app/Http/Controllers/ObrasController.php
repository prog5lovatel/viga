<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\Request;

class ObrasController extends SiteBaseController
{
    public function index()
    {
        $perPage = 16;

        $this->viewData['obras'] = Obra::paginate($perPage);

        return view('site.obras', $this->viewData);
    }
    public function detalhes($slugObra)
    {
        $obra = Obra::with('fotos')->where('slug', $slugObra)->firstOrFail();
        $this->viewData['obra'] = $obra;
        return view('site.obrasDetalhes', $this->viewData);

    }
}
